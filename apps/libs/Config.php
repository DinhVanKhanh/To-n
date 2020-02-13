<?php

    class apps_libs_Config

    {

        private $user;

        private $pass;

        private $host;

        private $database;

        private $savelog;

        function __construct()

        {

            $this->user='root';

            $this->pass='';

            $this->host='localhost';

            $this->database='test1';

            $this->savelog=false;

        }



        function GetUser()

        {

            return $this->user;

        }



        function GetPass()

        {

            return $this->pass;

        }



        function GetHost()

        {

            return $this->host;

        }



        function GetDatabase()

        {

            return $this->database;

        }



        function GetSaveLog()

        {

            return $this->savelog;

        }

    }

?>