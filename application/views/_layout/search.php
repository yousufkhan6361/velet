<div id="search">
    <button type="button" class="close">×</button>
    <form>
        <input type="search" value="" placeholder="SEARCH" />
        <input type="submit" value="Submit" />
    </form>
</div>


<script>
    $(document).ready(function () {
        var search_val;
        $('#btn-search').on('click',function () {
            search_val = $('#search').val();

            if(search_val==''){
                AdminToastr.error('Search field required','Info');
            }
            else{
                $('#form-search').submit();
            }
        });
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>