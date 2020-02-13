/*
1 alert-success
2 alert-info
3 alert-warning
4 alert-danger
*/
function create_noti(id, classify_alerts, mess) {
    var alert = "";
    switch (classify_alerts) {
        case 1:
            alert = "alert-success";
            break;
        case 2:
            alert = "alert-info";
            break;
        case 3:
            alert = "alert-warning";
            break;
        case 4:
            alert = "alert-danger";
            break;
        default:
            alert = "alert-success";
            break;
    }
    var html = '<div class="alert ' + alert + ' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + mess + '</div>'
    $("#" + id).html(html);
}
function up_page() {
    $('body,html').animate({
        scrollTop: 0
    })
}

function donw_page() {
    $('body,html').animate({
        scrollTop: 100000
    })
}

function editnumber(id) {
    var obj = $("#" + id);
    var string = obj.val();
    var string = cupnumber(string);
    var new_string = '';
    var j = 0;
    for (var i = string.length - 1; i >= 0; i--) {
        if (j % 3 == 0 && j != 0) new_string += ' ,';
        new_string += string[i];
        j++;
    }
    new_string = reverse(new_string);

    obj.val(new_string);
}

function eidtnumbers(number) {
    var number = cupnumber(number);
    var new_string = '';
    var j = 0;
    for (var i = number.length - 1; i >= 0; i--) {
        if (j % 3 == 0 && j != 0) new_string += ' ,';
        new_string += number[i];
        j++;
    }
    new_string = reverse(new_string);
    return new_string;
}

function editnumberpercent(e, id) {
    var key = e.which;
    var obj = $("#" + id);
    var string = obj.val();

    if (key == 8) {
        string = string.substr(0, string.length - 2);
    }

    var string = cupnumberpercent(string);
    obj.val(string + " %");
}

function cupnumberpercent(string) {
    string = string.toString();
    var new_string = '';
    var f = false;
    if (string.length > 0 & string[0] == ".") string = "0.";
    for (var i = 0; i < string.length; i++) {
        if (checknumberpercent(string[i])) {
            if (string[i] == "." & f) continue;
            new_string += string[i];
        }
        if (string[i] == ".") f = true;
    }

    return new_string;
}

function cupnumber(string) {
    string = string.toString();
    var new_string = '';
    for (var i = 0; i < string.length; i++)
        if (checknumber(string[i])) new_string += string[i];
    return new_string;
}

function reverse(s) {
    var o = '';
    for (var i = s.length - 1; i >= 0; i--)
        o += s[i];
    return o;
}

function checknumber(number) {
    switch (number) {
        case '0':
            return true;
            break;
        case '1':
            return true;
            break;
        case '2':
            return true;
            break;
        case '3':
            return true;
            break;
        case '4':
            return true;
            break;
        case '5':
            return true;
            break;
        case '6':
            return true;
            break;
        case '7':
            return true;
            break;
        case '8':
            return true;
            break;
        case '9':
            return true;
            break;
        default:
            return false;
            break;
    }
    return false;
}

function checknumberpercent(number) {
    switch (number) {
        case '0':
            return true;
            break;
        case '1':
            return true;
            break;
        case '2':
            return true;
            break;
        case '3':
            return true;
            break;
        case '4':
            return true;
            break;
        case '5':
            return true;
            break;
        case '6':
            return true;
            break;
        case '7':
            return true;
            break;
        case '8':
            return true;
            break;
        case '9':
            return true;
            break;
        case '.':
            return true;
            break;
        default:
            return false;
            break;
    }
    return false;
}
// Upload

var maxCount=1;
var countUploaded=0;
var checkUploaded=false;

function doUpload(id_file, id_pro, url, id_history_status_advisory) {
    document.getElementById(id_pro).innerHTML = ''; //Reset lại Progress-group
    var files = document.getElementById(id_file).files;
    maxCount=files.length;
    if (files.length == 0) return false;
    for (i = 0; i < files.length; i++) {
        uploadFile(files[i], i, id_file, id_pro, url, id_history_status_advisory);
    }
    return true;
}

function uploadFile(file, index, id_file, id_pro, url, id_history_status_advisory) {
    var http = new XMLHttpRequest();
    /** Khởi tạo vùng tiến trình **/
    //Div.Progress-group
    var ProgressGroup = document.getElementById(id_pro);
    //Div.Progress
    var Progress = document.createElement('div');
    Progress.className = 'progress';
    //Div.Progress-bar
    var ProgressBar = document.createElement('div');
    ProgressBar.className = 'progress-bar';
    //Div.Progress-text
    var ProgressText = document.createElement('div');
    ProgressText.className = 'progress-text';
    //Thêm Div.Progress-bar và Div.Progress-text vào Div.Progress
    Progress.appendChild(ProgressBar);
    Progress.appendChild(ProgressText);
    //Thêm Div.Progress và Div.Progress-bar vào Div.Progress-group  
    ProgressGroup.appendChild(Progress);


    //Biến hỗ trợ tính toán tốc độ
    var oldLoaded = 0;
    var oldTime = 0;
    //Sự kiện bắt tiến trình
    http.upload.addEventListener('progress', function event_send(event) {
        if (oldTime == 0) { //Set thời gian trước đó nếu như bằng không.
            oldTime = event.timeStamp;
        }
        //Khởi tạo các biến cần thiết
        var fileName = file.name; //Tên file
        var fileLoaded = event.loaded; //Đã load được bao nhiêu
        var fileTotal = event.total; //Tổng cộng dung lượng cần load
        var fileProgress = parseInt((fileLoaded / fileTotal) * 100) || 0; //Tiến trình xử lý
        var speed = speedRate(oldTime, event.timeStamp, oldLoaded, event.loaded);
        //Sử dụng biến
        ProgressBar.innerHTML = fileName + ' đang được upload...';
        ProgressBar.style.width = fileProgress + '%';
        ProgressText.innerHTML = fileProgress + '% Upload Speed: ' + speed + ' MB/s';
        //Chờ dữ liệu trả về
        if (fileProgress == 100) {
            ProgressBar.className += ' progress-bar-success'; //Thêm class Success
            ProgressBar.innerHTML=file.name+" Upload done!";
        }
        oldTime = event.timeStamp; //Set thời gian sau khi thực hiện xử lý
        oldLoaded = event.loaded; //Set dữ liệu đã nhận được
    }, false);


    //Bắt đầu Upload
    var data = new FormData();
    data.append('id_history_status_advisory', id_history_status_advisory);
    data.append(id_file, file);
    http.open('POST', url, true);
    http.send(data);


    //Nhận dữ liệu trả về
    http.onreadystatechange = function (event) {
        //Kiểm tra điều kiện
        if (http.readyState == 4 && http.status == 200) {
            ProgressBar.style.background = ''; //Bỏ hình ảnh xử lý
            try { //Bẫy lỗi JSON
                console.log(http.responseText);
                var server = JSON.parse(http.responseText);
                if (server.status) {
                    ProgressBar.className += ' progress-bar-success'; //Thêm class Success
                    ProgressBar.innerHTML = server.message; //Thông báo

                    countUploaded++;     
                    if(countUploaded==maxCount) checkUploaded=true;
                } else {
                    ProgressBar.className += ' progress-bar-danger'; //Thêm class Danger
                    ProgressBar.innerHTML = server.message; //Thông báo
                }
            } catch (e) {
                console.log(e);
                ProgressBar.className += ' progress-bar-danger'; //Thêm class Danger
                ProgressBar.innerHTML = 'Có lỗi xảy ra'; //Thông báo
            }
        }
      //  http.removeEventListener('progress', event_send); //Bỏ bắt sự kiện
    }
}

function speedRate(oldTime, newTime, oldLoaded, newLoaded) {
    var timeProcess = newTime - oldTime; //Độ trễ giữa 2 lần gọi sự kiện
    if (timeProcess != 0) {
        var currentLoadedPerMilisecond = (newLoaded - oldLoaded) / timeProcess; // Số byte chuyển được 1 Mili giây
        return parseInt(((currentLoadedPerMilisecond * 1000) / 1024)/1024); //Trả về giá trị tốc độ MB/s
    } else {
        return parseInt((newLoaded / 1024)/1024); //Trả về giá trị tốc độ MB/s
    }
}