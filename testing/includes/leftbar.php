<style>
#search {
  height: 30px;
  width: 30px;
  border: solid 5px;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  transition: 0.3s;
}

#search-input {
  height: 60%;
  width: 0px;
  font-size: 12px;
  font-weight: 600;
  background: none;
  color: #FFF;
  border: none;
  outline: 0;
  visibility: hidden;
  transition: 0.3s;
}

#search.active {
  width:200px;
}

#search-input.active {
  width: 80px;
  margin-left: 16px;
  visibility: visible;
}

</style>



<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">Main</li>
				
				<div id="search">
  <i class="fa fa-search" id="search-icon"></i>
  <form>
    <input type="text" id="search-input" name="search" autocomplete="off">
  </form>
</div>	


<li><a href="#"><i class="fa fa-motorcycle"></i> Vehicles</a>
					<ul>
						<li><a href="post_vehicle.php">Post a Vehicle</a></li>
						<li><a href="manage-vehicles.php">Manage Vehicles</a></li>
					</ul>
				</li>
				<li><a href="manage-bookings.php"><i class="fa fa-users"></i> Update Profile</a></li>

				<li><a href="testimonials.php"><i class="fa fa-table"></i> Manage Testimonials</a></li>
				<li><a href="manage-conactusquery.php"><i class="fa fa-desktop""></i> Manage Conatctus Query</a></li>
				<li><a href="reg-users.php"><i class="fa fa-users"></i> Reg Users</a></li>
			<li><a href="manage-pages.php"><i class="fa fa-files-o"></i> Manage Pages</a></li>
			<li><a href="update-contactinfo.php"><i class="fa fa-files-o"></i> Update Contact Info</a></li>

			<li><a href="manage-subscribers.php"><i class="fa fa-table"></i> Manage Subscribers</a></li>

			</ul>
		</nav>

		<script>
			const body = document.querySelector('body');
const searchBtn = document.querySelector('#search');
const searchInput = document.querySelector('#search-input');
let active = false;

body.addEventListener('click', (e) => {
  if(e.target.id === 'search' || e.target.id === 'search-input' || e.target.id === 'search-icon') {
    if(!active) {
      searchBtn.classList.add('active');
      searchInput.classList.add('active');
      active = true;
    }
  } else {
      searchBtn.classList.remove('active');
      searchInput.classList.remove('active');
      searchInput.value = '';
      active = false;
  }
});

		</script>