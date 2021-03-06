<?php
/**
 * 6486449j的主题
 * 
 * @package  6486449j Theme
 * @author 6486449j
 * @version 1.0
 * @link http://faxzit.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div class="col-mb-12 col-8" id="main" role="main">
	<?php while($this->next()): ?>
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
			<?php echo postThumb($this) ?>
			<div class="post-main">
				<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
				<ul class="post-meta">
					<li itemprop="author" itemscope itemtype="http://schema.org/Person"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
					<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
					<li><?php $this->category(','); ?></li>
					<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></a></li>
					<li><?php Postviews($this); ?></li>
				</ul>
				<div class="post-content" itemprop="articleBody">
					<?php $this->excerpt(100, '…'); ?>
            	</div>
				<div class="post-readmore"><a itemprop="url" href="<?php $this->permalink() ?>">阅读全文</a></div>
			</div>
        </article>
	<?php endwhile; ?>

    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
