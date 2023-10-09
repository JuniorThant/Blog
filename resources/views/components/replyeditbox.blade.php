            <form class="border replyeditsection" style="border-radius:20px;background-color:#E8E9EB;width:70%;padding:0;display:none;">
                    @csrf
                    <div class="row" style="padding:0;">
                        <div class="col-10">
                            <input type="hidden" class="urfilename" name="urfilename" value="{{ $blogpost->filename }}">
                            <input type="hidden" value="{{old('newr_id')}}" class="newr_id" name="newr_id" id="newr_id">
                            <input class="form-control border border-0 border-white bg-transparent replyeditbody" value="{{old('replyeditbody')}}" name="replyeditbody" id="replyeditbody">
                            <p class="text-danger showWarning" style="display:none;">Write Something, Please!</p>
                        </div>
                        <div class="col-2">
                            <button type="submit" id="replyUpdate" class="border border-0 bg-transparent replyUpdate">
                                <img src="/images/sendicon.png" alt="" style="width:80%;height:80%;">
                            </button>
                        </div>
                    </div>
            </form>