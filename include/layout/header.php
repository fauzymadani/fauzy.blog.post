<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $title ?? 'Halaman Saya'; ?></title>
	<link rel="stylesheet" href="style.css">
	<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="/rss.xml">
</head>

<body>
	<div class="container">
		<header>
			<div class="header-flex">
				<h1 data-i18n="title">Blog post</h1>
				<div class="search-container">
					<div class="gcse-search"></div>
				</div>
			</div>
			<nav class="topnav">
				<div class="nav-links">
					<a href="/" data-i18n="nav_about">Home</a>
					<a href="/tentang" data-i18n="nav_about">About</a>
					<a href="/proyek" data-i18n="nav_projects">Project</a>
					<a href="/kontak" data-i18n="nav_contact">Contact</a>
					<a href="/archive" data-i18n="nav_contact">Archive</a>
					<!-- <a href="/rss.xml" data-i18n="nav_contact">RSS</a> -->
				</div>
			</nav>
		</header>

		<div class="content-wrapper">
