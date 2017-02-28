$(function () {
    

    //Masked Input ============================================================================================================================
    var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });

    //===========================================================================================================================================

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });

    $('#select-all').click(function(){
      $('#optgroup').multiSelect('select_all');
      return false;
    });
    
    $('#deselect-all').click(function(){
      $('#optgroup').multiSelect('deselect_all');
      return false;
    });

});