<?php
document.addEventListener('DOMContentLoaded', function() {
    // Add click event listeners to rows in the main table
    document.querySelectorAll('#dataTable tbody tr').forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const category = this.getAttribute('data-category');
            const name = this.getAttribute('data-name');
            const itemPrice = parseFloat(this.getAttribute('data-price'));
            const sellingPrice = parseFloat(this.getAttribute('data-selling-price'));
            
            // Check if item already exists in detail table
            const existingRow = Array.from(document.querySelectorAll('#detailTable tbody tr'))
                                    .find(row => row.getAttribute('data-id') === id);

            if (existingRow) {
                // If item already exists, just update quantity
                const qtyCell = existingRow.querySelector('td:nth-child(3)');
                qtyCell.textContent = parseInt(qtyCell.textContent) + 1;
            } else {
                // If item does not exist, add new row to detail table
                const detailTableBody = document.querySelector('#detailTable tbody');
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-id', id);
                newRow.innerHTML = `
                    <td>${id}</td>
                    <td>${name}</td>
                    <td>1</td>
                    <td>${sellingPrice.toFixed(2)}</td>
                    <td><button class="delete-btn">Delete</button></td>
                `;
                detailTableBody.appendChild(newRow);
            }
        });
    });

    // Add click event listener for the delete button
    document.querySelector('#detailTable').addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
            event.target.closest('tr').remove();
        }
    });

    // Calculate customer profit when save button is clicked
    document.querySelector('a[href="save_sale.php"]').addEventListener('click', function(event) {
        event.preventDefault();

        const rows = document.querySelectorAll('#detailTable tbody tr');
        const numberOfItem = rows.length;
        const totalQty = Array.from(rows).reduce((acc, row) => acc +
            parseInt(row.querySelector('td:nth-child(3)').textContent || 0), 0);
        const total = parseFloat(document.getElementById('total_price').textContent) || 0;
        const totalDiscount = parseFloat(document.getElementById('discount_amount').textContent) || 0;

        console.log(`Total Qty: ${totalQty}`);
        console.log(`Total: ${total}`);
        console.log(`Total Discount: ${totalDiscount}`);

        let customerProfit = 0;

        if (numberOfItem === 0) {
            console.warn('No items found in the detail table.');
        } else {
            rows.forEach(row => {
                const itemId = row.getAttribute('data-id');
                console.log('Retrieved item ID:', itemId); // Log itemId for debugging

                if (itemId) {
                    const sellingPrice = parseFloat(row.querySelector('td:nth-child(4)').textContent) || 0;
                    const qty = parseInt(row.querySelector('td:nth-child(3)').textContent) || 0;

                    console.log(`Item ID: ${itemId}`);
                    console.log(`Selling Price: ${sellingPrice}`);
                    console.log(`Quantity: ${qty}`);

                    const itemRow = Array.from(document.querySelectorAll('#dataTable tbody tr'))
                        .find(tr => tr.getAttribute('data-id') === itemId);
                    const itemPrice = itemRow ? parseFloat(itemRow.getAttribute('data-price')) : null;

                    console.log(`Item Price: ${itemPrice}`);

                    if (itemPrice !== null) {
                        const itemProfit = ((itemPrice - sellingPrice) + totalDiscount) * qty;
                        customerProfit += itemProfit;
                        console.log(`Item Profit: ${itemProfit}`);
                    } else {
                        console.error(`Item with ID ${itemId} not found in dataTable.`);
                    }
                } else {
                    console.error('Item ID is null or undefined');
                }
            });
        }

        console.log(`Calculated Customer Profit: ${customerProfit}`);

        const subTotal = parseFloat(document.getElementById('subtotal').textContent) || 0;
        const paidAmount = parseFloat(document.getElementById('paid_amount').textContent) || 0;
        const balance = paidAmount - total;

        fetch('save_sale.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                numberOfItem: numberOfItem,
                totalQty: totalQty,
                total: total,
                totalDiscount: totalDiscount,
                customerProfit: customerProfit,
                subTotal: subTotal,
                paidAmount: paidAmount,
                balance: balance
            })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes('Sale saved successfully!')) {
                // Optionally redirect or perform another action
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

?>