<ul class="sidebar navbar-nav" id="sidebar">
	<li class="nav-item ">
	  <a class="nav-link" href="index.php">
		<i class="fas fa-fw fa-tachometer-alt"></i>
		<span>Početna</span>
	  </a>
    </li>
    <li class="nav-item">
	  <a class="nav-link" href="table_data.php">
		<i class="fas fa-fw fa-table"></i>
		<span>Tablice podataka</span></a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="calendar.php">
		<i class="fas fa-fw fa-calendar"></i>
		<span>Kalendar</span></a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" href="forecast.php">
		<i class="fas fa-fw fa-sun-o"></i>
		<span>Vremenska prognoza</span></a>
    </li>
	<li class="nav-item">
	  <a class="nav-link" href="http://blog.eagrar.eu">
		<i class="fas fa-fw fa-blog"></i>
		<span>Blog</span></a>
    </li>
    
	
	</ul>
	
	<script>
		// Get the container element
		$('.sidebar').on('click', 'li', function() {
    $('.nav-item li.active').removeClass('active');
    $(this).addClass('active');
});

	</script>