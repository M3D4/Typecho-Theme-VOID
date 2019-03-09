<?php
/**
 * VOID：无类型
 * 
 * 作者：<a href="https://www.imalan.cn">熊猫小A</a>
 * 
 * @package     Typecho-Theme-VOID
 * @author      熊猫小A
 * @version     1.6.3
 * @link        https://blog.imalan.cn/archives/247/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$setting = $GLOBALS['VOIDSetting'];
?>

<?php 
if(!Utils::isPjax() && !Utils::isAjax()){
    $this->need('includes/head.php');
    $this->need('includes/header.php');
}
if($setting['fancyIndex']) {
    $this->need('includes/index-alt.php');
} else {
?>

<main id="pjax-container">
    <title hidden>
        <?php Contents::title($this); ?>
    </title>
    
    <?php $this->need('includes/banner.php'); ?>

    <div class="wrapper container">
        <section id="index-list">
            <ul>
            <?php while($this->next()): ?>
                <li>
                    <article class="yue" itemscope itemtype="http://schema.org/Article">
                        <?php if($this->fields->banner != '' && $this->fields->bannerascover != '0'): ?>
                        <a href="<?php $this->permalink(); ?>" class="banner" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <img src="<?php echo $this->fields->banner;?>">
                            <meta itemprop="url" content="<?php echo $this->fields->banner; ?>">
                        </a>
                        <?php else: ?>
                        <div hidden itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?php if($this->fields->banner != '') echo $this->fields->banner; else Utils::gravatar($this->author->mail, 200);  ?>">
                        </div>
                        <?php endif; ?>
                        <a class="title" href="<?php $this->permalink(); ?>">
                            <h1 itemprop="name" data-words="<?php echo mb_strlen(preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $this->content), 'UTF-8'); ?>"><?php $this->title(); ?></h1>
                        </a>
                        <?php if($this->fields->excerpt != '') echo "<p itemprop=\"headline\" class=\"headline\">{$this->fields->excerpt}</p>"; ?>
                        
                        <?php if($this->fields->showfullcontent != '1'): ?>
                            <p class="excerpt content" <?php if($this->fields->excerpt == '') echo 'itemprop="headline"'; ?>><?php if(Utils::isMobile()) $this->excerpt(60); else $this->excerpt(100); ?><?php if($this->is('index')) echo " | <a class=\"full-link\" href=\"{$this->permalink}\">阅读全文</a>"; ?></p>
                        <?php else: ?>
                            <div itemprop="articleBody"><?php $this->content(); ?></div>
                        <?php endif; ?>

                        <div class="post-meta-index">Posted by <span itemprop="author"><?php $this->author(); ?></span> on <time datetime="<?php echo date('c', $this->created); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></div>
                        <meta itemprop="dateModified" content="<?php echo date('c', $this->modified); ?>">
                        <meta itemscope itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="<?php $this->permalink(); ?>">
                        <div hidden itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="<?php $this->options->title(); ?>">
                            <div itemprop="logo" itemscope="" itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="<?php Utils::gravatar($this->author->mail, 200);  ?>">
                            </div>
                        </div>
                    </article>
                </li>
            <?php endwhile; ?>
            </ul>
        </section>
        <?php $this->pageNav('<span aria-label="上一页">←</span>', '<span aria-label="下一页">→</span>', 1, '...', 'wrapClass=pager&prevClass=prev&nextClass=next'); ?>
    </div>
</main>

<?php }
if(!Utils::isPjax() && !Utils::isAjax()){
    $this->need('includes/footer.php');
} 
?>