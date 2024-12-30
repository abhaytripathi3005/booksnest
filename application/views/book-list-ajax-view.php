<!-- Book List Section -->
<section id="book-list" class="container">

	<?php if($books['count'] > 0){
	 foreach ($books['results'] as $resKey => $bk) { ?>
		<div class="book-card" data-genre="classic">
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
			<p class="author"><span class="Label-style">By </span> <?php echo $authors ? $authors : 'N/A'; ?></p>
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
        	<a href="<?php echo base_url().'?'.parse_url($books['previous'], PHP_URL_QUERY) ?>" class="prev-btn" id="previous-page-id" onclick="pagination('<?php echo parse_url($books["previous"], PHP_URL_QUERY); ?>')">Previous</a>
    	<?php } ?>
        <?php if($books['next']){ ?>
        	<a href="<?php echo base_url().'?'.parse_url($books['next'], PHP_URL_QUERY) ?>" class="next-btn" id="next-page-id"  onclick="pagination('<?php echo parse_url($books["next"], PHP_URL_QUERY); ?>')">Next</a>
    	<?php } ?>
    </div>
</section>