    <div class="border replysection" style="border-radius:20px;background-color:#E8E9EB;width:70%;padding:0;display:none;">
        <div class="row" style="padding:0;">
            <div class="col-9 col-sm-10 col-md-10 col-lg-9 col-xl-9">
                <input type="hidden" class="rfilename" value="{{$blogpost->filename}}" name="rfilename" >
                <input type="hidden" class="comment_id" value="{{$comment->id}}" name="comment_id">
                <input class="form-control border border-0 border-white bg-transparent replybody" name="replybody" id="replybody" placeholder="Reply a comment...">
                <p class="text-danger showWarning" style="display:none;">Write Something, Please!</p>
            </div>
            <div class="col-3 col-sm-2 col-md-2 col-lg-3 col-xl-3">
                <button type="submit" id="replySubmit" class="border border-0 bg-transparent replySubmit">
                    <img src="/images/sendicon.png" alt="" style="width:50%;height:50%;">
                </button>
            </div>
        </div>
    </div>