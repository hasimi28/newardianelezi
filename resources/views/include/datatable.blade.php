<script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>


<script type="text/javascript">


    $('#sampleTable').dataTable({
        // display everything

        "aaSorting": [[ 0, "desc" ]] // Sort by first column descending

    });

</script>