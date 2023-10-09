    <div class="border replysection" style="border-radius:20px;background-color:#E8E9EB;width:70%;padding:0;display:none;">
        <div class="row" style="padding:0;">
            <div class="col-10">
                <input type="hidden" class="rfilename" value="{{$blogpost->filename}}" name="rfilename" >
                <input type="hidden" class="comment_id" value="{{$comment->id}}" name="comment_id">
                <input class="form-control border border-0 border-white bg-transparent replybody" name="replybody" id="replybody" placeholder="Reply a comment...">
                <p class="text-danger showWarning" style="display:none;">Write Something, Please!</p>
            </div>
            <div class="col-2">
                <button type="submit" id="replySubmit" class="border border-0 bg-transparent replySubmit">
                    <img src="/images/sendicon.png" alt="" style="width:80%;height:80%;">
                </button>
            </div>
        </div>
    </div>