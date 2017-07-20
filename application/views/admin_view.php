<html>
<head>
	<title>Welcome $this->session->userdata('username')</title>
</head>
<body>
	<h1>Login berhasil !</h1>
	<h2>Hai, <?php echo $this->session->userdata('username'); ?></h2>
	<a href="<?php echo base_url('index.php/login/logout'); ?>" onclick="return confirm('Are You Sure ?')">Logout</a>
</body>
</html>