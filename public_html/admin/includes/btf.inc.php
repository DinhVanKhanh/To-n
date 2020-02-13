<?php 
	/**
	 * @ BTF là thuật toán mã hóa có độ phức tạp ($n+1)
	 * trong đó $n là số ký tự của key mã hóa.
	 *
	 * DANH SÁCH BIẾN
		$str: Chuỗi cần mã hóa
		$min - $max: $min <= $n <= $max ($min không được nhỏ hơn 5*2 và $max không được lớn hơn 62 / 2)
		$n : Độ dài của chuỗi chìa khóa (Được sinh ngẫu nhiên)
		$m: Độ dài của chuỗi cần mã hóa
		$fac: Giai thừa của $n!
		$k: Chuỗi chìa khóa (Được sinh ngẫu nhiên gồm $n ký tự không trùng nhau)
		$encrypt_str: Chuỗi kết quả sau khi mã hóa
		$sym_char: Ký tự đối xứng (gọi tắt là K)
		$k_f_c: Ký tự đầu của chuỗi chìa khóa (gọi tắt là K')
	 */

	//Hàm dùng để mã hóa
	function btf_encode( $str, $min=5, $max=7 ) {

	/**
	* Bước 0: Tạo ra số nguyên ngẫu nhiên 5 <= $n <= 7
	* Thay đổi biến $min và $max nếu cần thiết
	*/
		$n = rand( $min, $max );
		
		
	/**
	* Bước 1: Tạo khóa giải mã
	*/
		$fac = calc_fac( $n );
		$ascii = build_ascii( $fac );
		$k = rand_key( $ascii , $n, $fac ); //$k là khóa giải mã
	
		//Bảng ascii ánh xạ
		$ascii_b = build_ascii( $fac - 62 ); 
		$ascii_a = build_ascii( $fac + 62 );
		$ascii2 =  $ascii_b + $ascii + $ascii_a ;
	/**
	* Bước 2: Tiến hành mã hóa
	*/	
		$m = strlen( $str );
		
		//Mảng chứa các ký tự trong chuỗi cần mã hóa
		$str_chars = str_split( $str ); 
		
		$encrypt_str = ''; //Chuỗi đã mã hóa
		$encrypt_key = ''; //Key đã mã hóa
		
		for ( $i = 0; $i < $m; $i++ ) {
			//Dịch chuyển $n ô ký tự gốc thứ $i
			//Nếu cộng thêm $n mà lớn hơn vị trí của z trong ascii thì 
			// vị trí dịch chuyển sẽ được tính lại từ đầu (từ a xuống)
				$moved_pos = array_find( $str_chars[$i], $ascii ) + $n;
			
			//Lấy key đã hoán đổi vị trí 
				$key = str_shuffle( $k );
				
			//Cắt lấy ký tự đầu tiên của key (first character)
				$k_f_c = substr( $key, 0, 1 );
				
			//Tìm vị trí của $k_f_c trên ascii
				// Vị trí moved_pos nằm ở khúc nào thì kfc_pos được lấy ở khúc đó
				switch ( true ) {
					case ( $moved_pos <= $fac - 1 ):
						$kfc_pos = array_find( $k_f_c, $ascii );
						break;
					case ( $moved_pos > $fac - 1 ):
						$kfc_pos = array_find( $k_f_c, $ascii_a );
						break;
				}
				
			//Tính độ dài từ $k_f_c tới vị trí $moved_pos
				$L = $moved_pos - $kfc_pos;
				switch( true ) {
					case ( $L != 0 ):
						$sym_pos = $moved_pos + $L; 
						if( $sym_pos > $fac - 1 || $sym_pos < $fac - 62 || ($fac - 62 <= $sym_pos && $sym_pos <= $fac - 1 && $kfc_pos > $fac -1))
							$encrypt_key .= '1';
						else
							$encrypt_key .= '0';
						$sym_char = $ascii2[$sym_pos];
						break;
					//Nếu ký tự đầu tiên của chuỗi chìa khóa 
					// chính là ký tự gốc đã dịch chuyển
					case ($L == 0):
						$sym_char = $ascii2[$moved_pos];
						$encrypt_key .= '0';
						break;
				}
				
				//Xuất ra kết quả mã hóa (theo cặp KK')
				$encrypt_str .= $sym_char .= $k_f_c;
		}
		
		//Xuất ra chìa khóa mã hóa
		$encrypt_key .= str_pad((string)decbin( $n ), 8, '0', STR_PAD_LEFT );
		
		return array( $encrypt_str, $encrypt_key );
	} //Kết thúc hàm btf_encode();
	
	/**
	* Hàm tạo mảng ascii
	* @ Tham số truyền vô là giai thừa của $n (Mặc định: 120)
	*/
	function build_ascii( $fac = 120 ) {
		$ascii = array();
		$s = $fac - 62; //vị trí giá trị đầu tiên của bảng ASCII
		$e = $fac - 1;  //vị trí giá trị cuối cùng của bảng ASCII
		
		//Thêm giá trị số từ 0-9 vào ASCII
		for( $i = 0; $i < 10; $i++ ) {
			$ascii[$s + $i] = $i;
			$e = $s + $i;
		}
		
		//Thêm A-Z và a-z vào ASCII
		foreach ( range( 'A', 'Z' ) as $char ) {
			$e++;
			$ascii[$e] = $char;
			$ascii[++$e] = strtolower( $char );
		}
		return $ascii;
	}
	
	/**
	* Hàm random key gồm $n ký tự khác nhau
	*/
	function rand_key( $ascii , $n, $fac ) {
		$key = '';
		$dec_codes = array();
		for( $j = 0; $j < $n; $j++ ) {
			
			//Mã decimal cho một ký tự trong chuỗi chìa khóa
			$dec = rand( $fac - 62, $fac -1 ); 
			
			//Thêm một ký tự vào $key
			if( !in_array( $dec, $dec_codes ) ) {
				$key .= $ascii[$dec];
				array_push( $dec_codes, $dec );
			}
			else $j--;
		}
		return $key;
	}
	
	/**
	* Hàm tính giai thừa của $n
	*/
	function calc_fac( $n ) {
		//Tính giai thừa của $n!
		$n === 0 ? $fac = 1 : $fac = $n;
		while( $n - 1 > 0 ) {
			$fac*= ($n - 1);
			$n--;
		}
		return $fac;
	}
	
	
	/**
	* Hàm tìm key của phần tử trong mảng (case sensitive)
	*/
	function array_find( $needle, array $haystack )
	{
		foreach ( $haystack as $key => $value ) {
			if ( (string)$value === (string)$needle ) {
				return $key;
			}
		}
		return false;
	}
	
	/**
	* Hàm dịch ngược BTF
	*/
	function btf_decode( $str, $key ) {
		//Tính $n
		$n = bindec( (int)substr( $key, strlen( $key ) - 8 ) );
		
		$key = substr( $key, 0, strlen( $key ) - 8 );
		
		//Tính giai thừa của $n
		$fac = calc_fac( $n );
		
		//Tạo bảng mã ascii
		$ascii = build_ascii( $fac );
		$ascii2 = build_ascii( $fac - 62 );
		
		$ascii3 =  $ascii2 + $ascii ;
		
		//Mảng lưu các ký tự của chuỗi mã hóa cần dịch ngược
		$chars = str_split( $str );
		
		//Mảng lưu các ký tự của chìa khóa
		$keys = str_split( $key );

		//Kết quả đã dịch ngược
		$decrypt_str = '';
		
		//Biến chạy theo mảng chìa khóa
		$j = 0;
		
		//Vòng lặp giải mã
		for( $i = 0; $i < count( $chars ); $i+=2 ) {
			
			//Lấy K và K'
			$sym_char = $chars[$i];
			$k_f_c = $chars[$i+1];
			$k = $keys[$j];
			$j++;
			//Lấy vị trí của K và K'
			if( $k == '0' )
				$sym_pos = array_find( $sym_char, $ascii );
			else if ( $k == '1' )
				$sym_pos = array_find( $sym_char, $ascii2 );
			$kfc_pos = array_find( $k_f_c, $ascii );
			
			//Tính R (vị trí của ký tự gốc đã dịch chuyển n ô)
			$R1 = ( $sym_pos + $kfc_pos ) / 2;
			$R2 = ( ( 3*$kfc_pos ) - $sym_pos ) / 2;
			//Tìm ra vị trí của ký tự gốc trước khi dịch chuyển 
			//(string right position)
			
			abs( $R1 - $sym_pos ) === abs( $R1 - $kfc_pos ) ? $R = $R1 : $R = $R2;
			
			$str_r_pos = $R - $n;
			//Tìm ra ký tự chính xác
			$str_r_char = $ascii3[$str_r_pos];
			
			//Xuất ra kết quả dịch ngược
			$decrypt_str .= $str_r_char;
		}
		
		return $decrypt_str;
	}
?>