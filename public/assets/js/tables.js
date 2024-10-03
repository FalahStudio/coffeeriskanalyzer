$(document).ready(function () {
    var dataTable = $("#dataTable").DataTable({
        lengthChange: false,
        bInfo: false,
        ordering: false,
        language: {
            paginate: {
                sNext: '<li><a href="#" class="flex items-center justify-center w-8 h-8 ms-0 leading-tight text-gray-500 bg-white rounded-s-lg hover:bg-gray-100 hover:text-gray-700"> <span class="sr-only">Previous</span> <i class="iconsax text-2xl leading-none" icon-name="chevron-right"></i></a></li>',
                sPrevious:
                    '<li><a href="#" class="flex items-center justify-center w-8 h-8 ms-0 leading-tight text-gray-500 bg-white rounded-s-lg hover:bg-gray-100 hover:text-gray-700"> <span class="sr-only">Previous</span> <i class="iconsax text-2xl leading-none" icon-name="chevron-left"></i> </a> </li>',
            },
            zeroRecords: "Tidak ada data yang ditemukan",
        },
    });

    $("#dataTable_filter").hide();

    var paginationContainer = $("#paginationData");
    paginationContainer.append($("#dataTable_paginate"));

    $("#date-search").on("keyup", function () {
        var searchTerm = $(this).val();
        dataTable.search(searchTerm).draw();
    });

    $("#lengthSelect").on("change", function () {
        var selectedLength = $(this).val();
        dataTable.page.len(selectedLength).draw();
    });
});
