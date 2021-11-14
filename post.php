<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php echo postThumb($this) ?>
        <div class="post-main">
            <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
            <ul class="post-meta">
                <li itemprop="author" itemscope itemtype="http://schema.org/Person"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
                <li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
                <li><?php $this->category(','); ?></li>
                <li><?php Postviews($this);?></li>
            </ul>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, '无'); ?></p>
        </div>
    </article>

    <?php $this->need('comments.php'); ?>

    <div class="post-near-u">
        <ul class="post-near">
            <li class="post-prev">上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
            <li class="post-next">下一篇: <?php $this->theNext('%s','没有了'); ?></li>
        </ul>
    </div>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
