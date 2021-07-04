<?php
session_start();
session_destroy(); //para cerrar session

header("Location: ../index.php");
