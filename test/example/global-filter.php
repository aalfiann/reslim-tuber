<!-- Modal -->
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('filter_search')?></h4>
      </div>
      <form method="get" action="<?php echo Core::getInstance()->homepath?>/filtered.php">
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label><?php echo Core::lang('filter')?></label>
                    <select name="filter" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                        <option value="latest" <?php echo (empty($_GET['filter'])=='latest'?'selected':'')?>><?php echo Core::lang('latest')?></option>
                        <option value="rating" <?php echo (!empty($_GET['filter']) && $_GET['filter']=='rating'?'selected':'')?>><?php echo Core::lang('best_rating')?></option>
                        <option value="popular" <?php echo (!empty($_GET['filter']) && $_GET['filter']=='popular'?'selected':'')?>><?php echo Core::lang('most_popular')?></option>
                        <option value="favorite" <?php echo (!empty($_GET['filter']) && $_GET['filter']=='favorite'?'selected':'')?>><?php echo Core::lang('most_favorite')?></option>
                        <option value="alphabet" <?php echo (!empty($_GET['filter']) && $_GET['filter']=='alphabet'?'selected':'')?>><?php echo Core::lang('sort_alphabet')?></option>
                        <option value="released" <?php echo (!empty($_GET['filter']) && $_GET['filter']=='released'?'selected':'')?>><?php echo Core::lang('sort_released')?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('sort')?></label>
                    <select name="sort" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                        <option value="desc" <?php echo (!empty($_GET['sort']) && $_GET['sort']=='desc'?'selected':'')?>><?php echo Core::lang('sort_desc')?></option>
                        <option value="asc" <?php echo (!empty($_GET['sort']) && $_GET['sort']=='asc'?'selected':'')?>><?php echo Core::lang('sort_asc')?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('genre')?>1</label>
                    <select id="optionTags1" name="genre1" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('genre')?>2</label>
                    <select id="optionTags2" name="genre2" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('country')?></label>
                    <select id="optionCountry" name="country" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo Core::lang('year')?></label>
                    <select id="optionYear" name="year" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden; width:100%;background-color:white;'>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Core::lang('close')?></button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo Core::lang('search')?></button>
      </div>
      </form>
    </div>
  </div>
</div>