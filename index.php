<?php
error_log(serialize($_REQUEST), 0);
echo "<script>window.carrotData={username: undefined}</script>";
include('dist/index.html');