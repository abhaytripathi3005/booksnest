<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Book Collection</title>
	    <link rel="stylesheet" href="<?php echo base_url() ?>lib/css/styles.css">
	</head>

	<body>
	    <header>
	        <div class="container">
	            <h1>Welcome to the Book Collection</h1>
	            <p>Browse and filter through a collection of fascinating books!</p>
	        </div>
	    </header>

	    <!-- Filter and Search Section -->
	    <section id="filter-section" class="container">
	        <div class="filter-container">
	        	<form>
	            <!-- Search books by title or author -->
	            <input type="text" class="search-box" id="search-id" name="search" value="<?php echo $_GET['search'] ?>" placeholder="Search books by title or author" />

	            <!-- Search by Bookshelves or Subjects -->
				<input type="text" class="search-box" name="topic" id="topic-id" value="<?php echo $_GET['topic'] ?>" placeholder="Bookshelves or Subjects">
	            
	            <!-- Language Filter Dropdown -->

	            <select name="languages" id="lang-id">
	            	<option value="">All</option>
					<?php foreach (languageCodeList() as $key => $value): ?>
						<option value="<?php echo $key ?>" <?php echo $_GET['languages']==$key ? 'selected' : '' ?>><?php echo $value ?></option>
					<?php endforeach ?>
				</select>
				<button class="submit" onclick ="filterAndGetResult()">Submit</button>
				<a href="<?php echo base_url() ?>">Reset</a>
				</form>
	        </div>
	    </section>

		<!-- Full-Page Loader -->
		<div id="loader-wrapper" class="loader-wrapper hidden">
		    <div class="loader"></div>
		</div>
	    <div id="books-container">
		    <!-- Book List Section -->
		    <?php
		    	$data['books'] = $books;
		    	$this->load->view('book-list-ajax-view',$data);
		    ?>
		</div>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script type="text/javascript">
			function filterAndGetResult()
			{
				event.preventDefault();
				$('#loader-wrapper').removeClass('hidden');
				$.ajax({
				    url: "<?php echo base_url() ?>",
				    method: "GET",
				    dataType: "json",
				    data: {'from_view':'yes','search':$("#search-id").val(),'topic':$("#topic-id").val(),'languages':$("#lang-id").val()},
				    success: function(response) {
				        $("#books-container").html(response.html);
				        $('#loader-wrapper').addClass('hidden');
				    },
				    error: function(xhr, status, error) {
				        console.error("Error:", status, error);
				    }
				});
			}

			function pagination(qrStr=null) {
				event.preventDefault();
				$('#loader-wrapper').removeClass('hidden');
				$.ajax({
				    url: "<?php echo base_url() ?>",
				    method: "GET",
				    dataType: "json",
				    data: {'from_view':'yes','qrStr':qrStr},
				    success: function(response) {
				        $("#books-container").html(response.html);
				        $('#loader-wrapper').addClass('hidden');
				    },
				    error: function(xhr, status, error) {
				        console.error("Error:", status, error);
				    }
				});
			}
		</script>
	</body>

</html>

