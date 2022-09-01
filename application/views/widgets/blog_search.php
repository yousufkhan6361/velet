<?
// Get recent past (5)
$recent_post = $this->model_blog->get_recent_post();
// Get recent past (5)
$blog_category = $this->model_blog_category->get_recent_categories();
?>
<div class="col-md-3">
    <div class="sideBar">
        <div class="widget">
            <h2>Search by Title</h2>

            <div class="formSec">
                <form action="<?=g('base_url')?>blog/search" method="post">
                    <div class="col-md-10 col-sm-10 col-xs-10 noPadding">
                        <input type="text" placeholder="Search" name="search"/>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 noPadding">
                        <input type="submit" value="" id="btn-blog-search"/>
                    </div>
                </form>
            </div>
        </div>
        <!--<div class="widget">
            <h2>Search by Keywords</h2>

            <div class="formSec">
                <div class="col-md-10 col-sm-10 col-xs-10 noPadding">
                    <input type="text" placeholder="Search"/>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 noPadding">
                    <input type="submit" value=""/>
                </div>
            </div>
        </div>-->

        <div class="widget cat">
            <h2>Categories</h2>
            <ul>
                <?
                if(array_filled($blog_category)){
                    foreach($blog_category as $key=>$value):?>
                        <li><a href="<?=g('base_url')?>blog-category/<?=$value['blog_category_slug']?>"><?=$value['blog_category_name']?></a></li>
                    <?endforeach;
                }
                ?>
            </ul>
        </div>

        <div class="widget mostRec">
            <h2>Most Recent</h2>
            <ul>
                <?
                if(array_filled($recent_post)){
                    foreach($recent_post as $key=>$value): ?>
                        <li><a href="<?=g('base_url')?>blog/<?=$value['blog_slug']?>"><?=$value['blog_name']?></a></li>
                    <? endforeach;
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#btn-blog-search').on('click',function(){
            var search = $('input[name=search]').val();
            if(search==''){
                AdminToastr.error('Please enter text','Error');
                return false;
            }
            else if(search.length<3){
                AdminToastr.error('Please enter 3 or more character ','Error');
                return false;
            }
        });
    });
</script>