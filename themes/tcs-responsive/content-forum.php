<script type="text/javascript">
	var url = "<?php bloginfo( 'stylesheet_directory' ); ?>/data/forum.json";
	var postPerPage=<?php echo get_option('forumPostPerPage'); ?>;
	$(document).ready(function(){
		app.forum.populate(url);
		});
</script>
<article class="forumPosts">
	<div class="container">
		<h2>
			Recent Forum Posts <small class="nPost">(  posts)</small>
		</h2>
		<div class="forumList">
			<!-- populated dynamically using AJSX -->
			<div class="post postDesign">
				<a href="#" class="thumb"></a>
				<div class="head">
					<a href="#" class="postTitle">Algorithm Final Round Hard </a>
					<span class="postedBy">Last Post by: <a href="#" class="postAuthor">Mahestro</a></span>
				</div>
				<div class="postBody">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>

				<div class="postInfo">
					<div class="row">
						<a href="#" class="postCat">2013 TopCoder Open</a>
						<span class="sep"></span><span class="postedAt">Nov 14, 2013 at 2:31 AM</span>
					</div>
					<div class="row">
						<span class="info"><em>8</em> Threads</span><span class="sep"></span><span class="info"><em>24</em> Messages</span>
					</div>
				</div>
			</div>
			<!-- /.post -->

		</div>
		<!-- /.forumList -->
		<div class="dataChanges">			
			<div class="rt pager">
				<a href="#0" class="prevLink hide">
					<i></i> Prev
				</a>
				<a href="#1" class="isActive pageLink">
					1
				</a>
				<a href="#2" class="pageLink">
					2
				</a>
				<a href="#3" class="pageLink">
					3
				</a>
				<a href="#4" class="pageLink">
					4
				</a>
				<a href="#5" class="pageLink">
					5
				</a>
				<a href="javascript:;" class="nextLink">
					Next <i></i>
				</a>
			</div>
			<div class="mid onMobi">
				<a href="#" class="viewPastCh">
					View Past Challenges<i></i>
				</a>
			</div>
		</div>
		<!-- /.dataChanges -->
	</div>
</article>
