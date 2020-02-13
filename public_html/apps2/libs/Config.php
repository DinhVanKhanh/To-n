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

            $this->user='smartbrain_main';

            $this->pass='123@uUsmartbrain';

            $this->host='localhost';

            $this->database='smartbrain_main';

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