<?php $this->load->view('_header') ?>
<?php $this->load->view('_nav') ?>
<div id="main">
	<div class="search">
		<form action="<?php echo site_url('search'); ?>/sresult" method="post" class="from"><input id="search-key" class="text fl" type="text" name="keyword" value="|想要什么尽管搜" autocomplete="off"/>
		<input class="button fl" type="submit" value="搜索" title="搜索" /></form>
	</div>
</div>
	
<script type="text/javascript">	
$(document).ready(function() {	
	$("#search-key").autocomplete('<?php echo site_url('search/dosync'); ?>',{
					width: 365,
					max:5,
		}); 
});
</script>

<?php $this->load->view('_footer') ?>