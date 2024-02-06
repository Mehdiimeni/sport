<?php
///template/global/page_js.php
?>


<!-- Vendor js -->
<script src="../itheme/panel/js/vendor.min.js"></script>

<!-- Fullcalendar js -->
<script src="../itheme/panel/vendor/fullcalendar/main.min.js"></script>

<!-- Calendar App Demo js -->
<script src="../itheme/panel/js/pages/demo.calendar.js"></script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- اضافه کردن کتابخانه Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- App js -->
<script src="../itheme/panel/js/app.min.js"></script>


<script>

    var dropdownItems = document.querySelectorAll('.lang-set');

    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedLanguage = item.getAttribute('data-lang');
            document.cookie = 'admin_language=' + selectedLanguage + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';

            location.reload();
        });
    });

    function generateRandomColors(count) {
    var colors = [];
    for (var i = 0; i < count; i++) {
        colors.push(`rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.2)`);
    }
    return colors;
}


    $.ajax({
        url: '../icore/status/tags.php',
method: 'GET',
dataType: 'json',
success: function (data) {
    var ctx = document.getElementById('tagsChart').getContext('2d');
    var backgroundColors = generateRandomColors(data.tagNames.length);

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.tagNames,
            datasets: [{
                data: data.tagCounts,
                backgroundColor: backgroundColors,
                borderColor: backgroundColors.map(color => color.replace('0.2', '1')),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
},
error: function () {
    console.error('خطا در دریافت اطلاعات از فایل "tags".');
}

    });





</script>

<script src="../itheme/panel/js/ticket.js"></script>




</body>


</html>