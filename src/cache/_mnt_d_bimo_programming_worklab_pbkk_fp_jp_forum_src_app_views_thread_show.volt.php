<?= $this->tag->getDoctype() ?>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->tag->rendertitle() ?>
        <?= $this->assets->outputCSS('header') ?>

        <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= $this->url->get('img/favicon.ico') ?>"/> -->
    </head>

    <body>
        
        <?php if ($this->session->has('auth')) { ?>
        <?= $this->partial('partials/auth/navbar') ?><?php } else { ?><?= $this->partial('partials/guest/navbar') ?>
        <?php } ?> 
        
         
<?php $rt = json_decode($root); ?>
<?php $sb = json_decode($root->subforum); ?>
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-light p-5">
            <div class="row justify-content-between">
                <div class="col-4">
                    <div class="row">
                        <h4> <?= $root->title ?> </h4>
                    </div>
                    <div class="row">
                        <h5> By <?= $root->user->username ?> </h5>
                    </div>
                    <div class="row ">
                    <?php if ($this->session->get('auth')['role'] > 0) { ?>
                        <?php if ($rt->locked == true) { ?>
                        <?php $lock = false; ?>
                        <?php $sLock = 'Unlock'; ?>
                        <?php } else { ?>
                        <?php $lock = true; ?>
                        <?php $sLock = 'Lock'; ?>
                        <?php } ?>

                        <?php if ($rt->pinned == true) { ?>
                        <?php $pin = false; ?>
                        <?php $sPin = 'Unpin'; ?>
                        <?php } else { ?>
                        <?php $pin = true; ?>
                        <?php $sPin = 'Pin'; ?>
                        <?php } ?>
                        <form class="form-inline" action="<?= $this->url->get('/thread/lock/') ?>" method="POST">
                            <input type="hidden" name="l_val" value="<?= $lock ?>">
                            <input type="hidden" name="l_id" value="<?= $rt->id ?>">
                            <button class="btn btn-link text-info my-2 my-sm-0" type="submit"><h6><?= $sLock ?></h6></button>
                        </form> 
                        <h5>|</h5>
                        <form class="form-inline" action="<?= $this->url->get('/thread/pin/') ?>" method="POST">
                            <input type="hidden" name="p_val" value="<?= $pin ?>">
                            <input type="hidden" name="p_id" value="<?= $rt->id ?>">
                            <button class="btn btn-link my-2 text-success my-sm-0" type="submit"><h6><?= $sPin ?></h6></button>
                        </form>
                        <?php if ($this->session->get('auth')['role'] > 1) { ?>
                        <h5>|</h5>
                        <form class="form-inline" action="<?= $this->url->get('/thread/delete/') ?>" method="POST">
                            <input type="hidden" name="d_id" value="<?= $rt->id ?>">
                            <button class="btn btn-link text-danger my-2 my-sm-0" type="submit"><h6>Delete</h6></button>
                        </form>                        
                    </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="col-4 align-self-center">
                    <div class="row">
                        <h6>Created at: <?= date('j-M-y', $rt->created_at) ?></h6>
                    </div>
                    <div class="row">
                        <h6>Last Reply: <?= date('j-M-y', $rt->updated_at) ?></h6>
                    </div>
                </div>
            </div>
            <table class="table border-top border-bottom">
                <tbody class="th text-center">
                    <?php foreach ($replies as $reply) { ?>
                    <tr>
                        <th>
                            <div class="row text-justify">
                                <div class="col-1">
                                    <div class="row">
                                    </div>
                                    <div class="row text-center" >
                                        <a href="<?= $this->url->get('/user/show/') . $reply->user->id ?>"><h6  style="word-wrap:break-word;width:50px;"> <?= $reply->user->username ?></h6></a>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <?php if ($reply->deleted == false) { ?>
                                    <h5> <?= $reply->content ?> </h5>
                                    <?php if (isset($reply->edited_by)) { ?>
                                    <h6 class="font-italic text-muted"> Edited by <?= $reply->edited_by ?> </h6>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <h6 class="font-italic text-muted"> Deleted by <?= $reply->edited_by ?> </h6>
                                    <?php } ?>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="row"> 
                                        <?php if (($this->session->get('auth')['uid'] == $reply->user->id || $this->session->get('auth')['role'] > 0) && $reply->deleted == false) { ?>
                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Post</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form class="form" action="<?= $this->url->get('/thread/edit') ?>" method="POST">
                                                        <input type="hidden" name="e_id" value="<?= $reply->id ?>">
                                                        <input type="hidden" name="e_rid" value="<?= $rt->id ?>">

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <textarea class="form-control" id="content" name="content" placeholder="Edit your reply" ><?= $reply->content ?></textarea>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary my-2 my-sm-0" type="submit"><h6>Edit</h6></button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-link my-2 my-sm-0" data-toggle="modal" data-target="#myModal"><h6>Edit</h6></button>
                                        <h5>|</h5>
                                        <form class="form-inline" action="<?= $this->url->get('/thread/hide') ?>" method="POST">
                                            <input type="hidden" name="h_id" value="<?= $reply->id ?>">
                                            <button class="btn btn-link text-danger my-2 my-sm-0" type="submit"><h6>Hide</h6></button>
                                        </form>                                        
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <h6>Posted at: <?= date('j-M-y', $reply->created_at) ?></h6>
                                    </div>
                                    <?php if ($reply->updated_at != $reply->created_at) { ?>
                                        <?php if ($reply->deleted == true) { ?>
                                        <div class="row">
                                            <h6>Deleted at: <?= date('j-M-y', $reply->updated_at) ?></h6>
                                        </div>
                                        <?php } else { ?> 
                                        <div class="row">
                                            <h6>Edited at: <?= date('j-M-y', $reply->updated_at) ?></h6>
                                        </div>                              
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
            <?php if ($root->locked == 0 && isset($this->session->get('auth')['uid'])) { ?> 
            <div class="row">
                <div class="col">
                    <div class="h4 mb-3">Reply to Thread</div>
                        <form action="<?= $this->url->get('/thread/reply') ?>" method="POST">
                            <input type="hidden" name="r_id" value="<?= $rt->id ?>">
                            <input type="hidden" name="r_uid" value="<?= $this->session->get('auth')['uid'] ?>">
                            <input type="hidden" name="r_sid" value="<?= $sb->id ?>">
                            <div class="form-group row pb-1">
                                <div class="col-md">
                                    <textarea class="form-control" id="content" name="content" placeholder="Reply to thread..."></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-auto">Reply</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>




        


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <?= $this->assets->outputJS('js') ?>

</html>