document.addEventListener("DOMContentLoaded", function () {
    // Function to update the expected price
    function updateExpectedPrice() {
        var total = 0;

        // Iterate through each row in the table
        document.querySelectorAll('.summarytable tr').forEach(function (row, index) {
            if (index !== 0) {
                var subtotal =  parseFloat(row.querySelector('.subtotal').textContent);
                total += subtotal;
            }
        });

        // Update the expected price
        document.getElementById('expectedPrice').textContent = total.toFixed(0);

        document.getElementById("hiddenTotalPrice").value=total.toFixed(0);
    }

    // Call the function
    updateExpectedPrice();
});
