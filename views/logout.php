<?php
$url = base_url();
UnsetSession('user_id');
header("Location: $url");