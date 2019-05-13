<?php $postHandler = new postHandler(); ?>

<?php $shorted = $postHandler->getAzShorted(); ?>
<?php //var_dump($shorted); ?>

<script type="text/javascript">
	var shorted = <?php echo json_encode($shorted); ?>;
</script>
			
			
<a id="filter-az" href="#" class="button" aria-label="Filter a-z">A-Z</a>