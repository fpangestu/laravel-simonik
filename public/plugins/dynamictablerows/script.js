var TableManager = function(tableId, rowTag) {
  var mgr = {};
  mgr.tableId = tableId;
  mgr.rowTag = rowTag;

  mgr.appendRow = function(obj) {
    var table = $("#" + mgr.tableId);
    var newRow = table.find("#" + mgr.tableId + "_template").clone();
    mgr.wireUpRow(newRow);
    mgr.setRowData(newRow, obj);
    table.append(newRow);
  }

  mgr.appendEmptyRow = function() {
    mgr.appendRow({
      name: null,
      value: null
    });
  }

  mgr.prependRow = function(obj) {
    var table = $("#" + mgr.tableId);
    var newRow = table.find("#" + mgr.tableId + "_template").clone();
    mgr.wireUpRow(newRow);
    mgr.setRowData(newRow, obj);
    table.prepend(newRow);
  }

  mgr.wireUpRow = function(row) {
    row.find('button[name="' + mgr.rowTag + '_add"]').click(function() {
      mgr.appendEmptyRow();
    });

    row.find('button[name="' + mgr.rowTag + '_delete"]').click(function(evt) {
      var table = $("#" + mgr.tableId);
      var numTableRows = table.find('tr[title="annotation"]').size();
      if (numTableRows > 1) {
        $(evt.target).parents('tr').remove();
      }
    });
  }

  mgr.getRowData = function(row) {
    var data = {};
    var prefix = mgr.rowTag + "_";
    $(row).find('input,select,textarea').each(function(index, element) {
      var name = $(element).attr('name');
      var bareName = name.slice(name.indexOf(prefix) + prefix.length);

      data[bareName] = $(element).val();
    });
    return data;
  }

  mgr.setRowData = function(row, obj) {
    Object.getOwnPropertyNames(obj).forEach(function(name, idx, array) {
      row.find('input[name="' + mgr.rowTag + '_' + name + '"]').val(obj[name]);
    });
  }

  var table = $("#" + mgr.tableId);
  mgr.wireUpRow(table.find("#" + mgr.tableId + "_template"));

  return mgr;
}

var AnnotationTableManager = new TableManager('annotations', 'annotation');

$(document).ready(function() {
  AnnotationTableManager.prependRow({
    "name": "Tissue",
    "value": "Lung"
  });
});