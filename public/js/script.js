const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
dropdownButtons.forEach(button => {
    const icon = button.querySelector('i.icon');
    button.addEventListener('click', function (event) {
        event.stopPropagation();
        const targetDropdown = document.getElementById(button.getAttribute('data-dropdown-toggle'));
        targetDropdown.classList.toggle('hidden');
        if (targetDropdown.classList.contains('hidden')) {
            icon.classList.remove('fa-angle-down');
            icon.classList.add('fa-angle-left');
        } else {
            icon.classList.remove('fa-angle-left');
            icon.classList.add('fa-angle-down');
        }
    });
});

function calculateTotals() {
    let subTotal = 0;

    document.querySelectorAll(".order-item").forEach((item) => {
        const price = parseFloat(item.dataset.price);
        const quantity = parseInt(item.querySelector(".quantity").value);
        subTotal += price * quantity;
    });

    if (subTotal < 100) {
        taxperson = 5;
    } else if (subTotal < 200) {
        taxperson = 4;
    } else if (subTotal < 300) {
        taxperson = 3;
    }

    // Update tax calculation if needed
    const tax = subTotal * (taxperson / 100);
    const total = subTotal + tax;

    document.querySelector(".subtotal span").textContent = `$${subTotal.toFixed(2)}`;
    document.querySelector(".taxperson span").textContent = `Tax ${taxperson}%`;
    document.querySelector(".tax span").textContent = `$${tax.toFixed(2)}`;
    document.querySelector(".total span").textContent = `$${total.toFixed(2)}`;
}

// Function to add item to order list
function addItemToOrder(name, price, image) {
    const orderList = document.querySelector(".order-list");

    // Check if item already exists
    const existingItem = Array.from(orderList.children).find(
        (item) => item.dataset.name === name
    );

    if (existingItem) {
        const quantityInput = existingItem.querySelector(".quantity");
        quantityInput.value = parseInt(quantityInput.value) + 1;
    } else {
        // Add new item
        const listItem = document.createElement("li");
        listItem.className = "flex items-center justify-between w-full p-1 bg-gray-200 border-2 border-b-orange-400 order-item";
        listItem.dataset.name = name;
        listItem.dataset.price = price;

        listItem.innerHTML = `
            <div class="w-10 h-10 mr-2 rounded-md shadow-xl">
                <img src="${image}" alt="${name}" class="rounded-md shadow-lg">
            </div>
            <div class="flex-1">
                <p>${name}</p>
                <p>$${price}</p>
            </div>
            <div class="flex items-center gap-1">
                <i onclick="updateQuantity('minus', this)" class="text-red-400 fas fa-minus-circle mr-1"></i>
                <input type="number" class="w-10 text-center quantity" value="1" min="1">
                <i onclick="updateQuantity('plus', this)" class="text-blue-500 fas fa-plus-circle ml-1"></i>
            </div>
        `;

        orderList.appendChild(listItem);
    }

    calculateTotals();
}

// Function to update quantity
function updateQuantity(action, element) {
    const quantityInput = element.parentElement.querySelector(".quantity");
    let quantity = parseInt(quantityInput.value);

    if (action === "plus") {
        quantity += 1;
    } else if (action === "minus") {
        quantity -= 1;
        if (quantity <= 0) {
            // Remove item if quantity is 0
            removeItem(element);
            return;
        }
    }

    quantityInput.value = quantity;
    calculateTotals();
}

// Function to remove an item from the order list
function removeItem(element) {
    const orderItem = element.closest(".order-item");
    orderItem.remove();
    calculateTotals();
}

// Attach event listeners to Add buttons
document.querySelectorAll(".add-button").forEach((button) => {
    button.addEventListener("click", (e) => {
        const productCard = e.target.closest(".product-card");
        const name = productCard.querySelector("p").textContent;
        const price = parseFloat(productCard.querySelector("p + p").textContent.replace("$", ""));
        const image = productCard.querySelector("img").src;

        addItemToOrder(name, price, image);
    });
});
