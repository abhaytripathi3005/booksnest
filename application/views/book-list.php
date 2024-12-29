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
            <!-- Search Input -->
            <input type="text" class="search-box" id="search-id" value="<?php echo $_GET['search'] ?>" placeholder="Search books by title or author" />
			<label for="topic-id">Bookshelves or Subjects</label>
			<input type="text" class="search-box" name="topic" id="topic-id" value="<?php echo $_GET['topic'] ?>" placeholder="Bookshelves or Subjects">
            <!-- Language Filter Dropdown -->

            <select name="languages" id="lang-id">
            	<option value="">All</option>
				<?php foreach (languageCodeList() as $key => $value): ?>
					<option value="<?php echo $key ?>" <?php echo $languages==$key ? 'selected' : '' ?>><?php echo $value ?></option>
				<?php endforeach ?>
			</select>
			<button onclick ="filterAndGetResult()">Submit</button>
			<input type="reset" value="Reset">
			</form>
        </div>
    </section>

	<!-- Full-Page Loader -->
<div id="loader-wrapper" class="loader-wrapper hidden">
    <div class="loader"></div>
</div>
    <div id="books-container">
	    <!-- Book List Section -->
	    <section id="book-list" class="container">

	    	<?php if($books['count'] > 0){
	    	 foreach ($books['results'] as $resKey => $bk) { ?>
	    		<div class="book-card" data-genre="classic">
	    		<!-- <img src="book3.jpg" alt="Book 3 Cover"> -->
	    		<h3><?php echo $bk->title; ?></h3>
						<?php
							$authors = NULL;
							foreach ($bk->authors as $authKey => $auth)
							{ 
								$authDetail = NULL;
								$authDetail = $auth->name.' ('.$auth->birth_year.'-'.$auth->death_year.')';
								if($authors && $auth->name)
								{
									$authors = $authors.', '.$authDetail; 
								}
								else
								{
									$authors = $authDetail;
								}
							} 
						?>
							<p class="author"><span class="Label-style">By </span> <?php echo $authors; ?></p>
							<p class="description"><span class="Label-style">Subject: </span><?php echo implode(", ", $bk->subjects) ?></p>
							<p class="description"><span class="Label-style">Language: </span><?php echo implode(", ", languageCodeList($bk->languages)) ?></p>
							<p class="description"><span class="Label-style">Book Type: </span><?php echo $bk->media_type; ?></p>
					</div>
				<?php }} else{ ?>
				<!-- No Data Message -->
	            <div id="no-data" class="no-data hidden">
	                <p>No books available to display</p>
	            </div>
	        <?php } ?>
	    </section>
	    <!-- Pagination Section -->
		<section id="pagination" class="container">
		    <div class="pagination">
		    	<?php if($books['previous']){ ?>
		        <button class="prev-btn" id="previous-page-id" onclick="pagination('<?php echo parse_url($books["previous"], PHP_URL_QUERY); ?>')">Previous</button>
		    <?php } ?>
		        <!-- <span class="page-num">Page 1 of 5</span> -->
		        <?php if($books['next']){ ?>
		        <button class="next-btn" id="next-page-id"  onclick="pagination('<?php echo parse_url($books["next"], PHP_URL_QUERY); ?>')">Next</button>
		    <?php } ?>
		    </div>
		</section>
	</div>

    <!-- <script src="script.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
	function filterAndGetResult()
	{
		$('#loader-wrapper').removeClass('hidden');
		event.preventDefault();
		$.ajax({
		    url: "<?php echo base_url() ?>", // API endpoint
		    method: "GET", // HTTP method
		    dataType: "json",
		    data: {'from_view':'yes','search':$("#search-id").val(),'topic':$("#topic-id").val(),'languages':$("#lang-id").val()},
		    success: function(response) {
		        // Handle the response from the server
		        $("#books-container").html(response.html);
		        $('#loader-wrapper').addClass('hidden');
		    },
		    error: function(xhr, status, error) {
		        // Handle errors
		        console.error("Error:", status, error);
		    }
		});
	}

	function pagination(qrStr=null) {
		$('#loader-wrapper').removeClass('hidden');
		$.ajax({
		    url: "<?php echo base_url() ?>", // API endpoint
		    method: "GET", // HTTP method
		    dataType: "json",
		    data: {'from_view':'yes','qrStr':qrStr},
		    success: function(response) {
		        // Handle the response from the server
		        $("#books-container").html(response.html);
		        $('#loader-wrapper').addClass('hidden');
		    },
		    error: function(xhr, status, error) {
		        // Handle errors
		        console.error("Error:", status, error);
		    }
		});
	}
</script>
</body>

</html>

