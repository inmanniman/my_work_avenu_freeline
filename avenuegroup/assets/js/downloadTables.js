// Добавьте этот код в ваш файл скрипта
import { saveAs } from 'file-saver';
document.addEventListener('DOMContentLoaded', function () {
  var downloadBtn = document.querySelector('.filter__download-btn');
  downloadBtn.addEventListener('click', function () {
    exportTableToExcel('tables', 'exported_data');
  });

  function exportTableToExcel(tableId, filename) {
    var table = document.getElementById(tableId);
    var ws = XLSX.utils.table_to_sheet(table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
    var wbout = XLSX.write(wb, {
      bookType: 'xlsx',
      bookSST: true,
      type: 'binary',
    });

    function s2ab(s) {
      var buf = new ArrayBuffer(s.length);
      var view = new Uint8Array(buf);
      for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
      return buf;
    }

    saveAs(
      new Blob([s2ab(wbout)], { type: 'application/octet-stream' }),
      filename + '.xlsx'
    );
  }
});
