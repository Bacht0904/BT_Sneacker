let index = 0;

function deleteRow(btn) {
    var row = btn.parentNode;
    index -= 1;
    row.remove(row);
}
function deleteRows(btn) {
    var row = btn.parentNode.parentNode;
    index -= 1;
    row.remove(row);
}

    // chọn size
    document.getElementById("btn-add-num").style.display = 'none';
    document.getElementById("num-size").onclick = function () {
        document.getElementById("btn-add-num").style.display = 'block';
        document.getElementById("btn-add-text").style.display = 'none';
    };

    document.getElementById("text-size").onclick = function () {
        document.getElementById("btn-add-num").style.display = 'none';
        document.getElementById("btn-add-text").style.display = 'block';
    };

function add_append() {
    index = index + 1;
    let addColorRow = '<div class="form-group form-inline ml-md-4 img-color"><label for="color"> Tên màu :</label><input type="text" name="color_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden><input type="text" id="color" name="color_name[]" placeholder="Tên màu" class="form-control col-md-3 mx-sm-3"><input type="file" accept="image/*" required name="image_colors[]"> <button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button><div class="form-group ml-2" hidden><label for="status">Trạng thái </label> &ensp; <select name="color_status[]" class="form-control"><option value="0" >Ngưng hoạt động</option><option value="1" selected>Đang hoạt động</option></select></div></div>';
    $('.add_color_and_size').append(addColorRow);
}

function add_size_text() {
    index = index + 1;
    let addSizeRow = '<div class="form-group form-inline ml-md-4 img-color"><label for="size"> Tên size: </label><input type="text" name="size_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden><select name="size_name[]" id="size" class="form-control ml-2"><option value="S">S</option><option value="M">M</option><option value="L">L</option><option value="XL">XL</option><option value="XXL">XXL</option><option value="One Size">One size</option></select><button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button><div class="form-group ml-2" hidden ><label for="status">Trạng thái </label> &ensp;<select name="size_status[]" class="form-control"><option value="0" >Ngưng hoạt động</option><option value="1" selected>Đang hoạt động</option></select></div></div>';
    $('.add_size').append(addSizeRow);
}
function add_size_num() {

    index = index + 1;
    let addSizeRow = '<div class="form-group form-inline ml-md-4 img-color"><label for="size"> Tên size: </label><input type="text" name="size_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden><select name="size_name[]" id="size" class="form-control ml-2"><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option></select><button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button><div class="form-group ml-2" hidden ><label for="status">Trạng thái </label> &ensp;<select name="size_status[]" class="form-control"><option value="0" >Ngưng hoạt động</option><option value="1" selected>Đang hoạt động</option></select></div></div>';
    $('.add_size').append(addSizeRow);
}

function add_product(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);

    row.deleteCell(3);
    var cell = row.insertCell(3);
    cell.innerHTML = '<button onclick="remove_product(this);" type="button"  class="btn btn-danger"><i class="fa-solid fa-minus"></i></button>';
    document.getElementById("dataTableSlide").append(row);
}

function remove_product(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);

    row.deleteCell(3);
    var cell = row.insertCell(3);
    cell.innerHTML = '<button onclick="add_product(this);" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus"></i></button>';
    document.getElementById("dataTable").append(row);

}

