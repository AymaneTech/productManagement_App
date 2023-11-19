let localData = JSON.parse(localStorage.getItem("product"));
const title = document.getElementById("title");
const create = document.getElementById("submit");
// price inputs
const price = document.getElementById("price");
const taxes = document.getElementById("taxes");
const ads = document.getElementById("ads");
const discount = document.getElementById("discount");
const totalResult = document.getElementById("total");
const category = document.getElementById("category");
const tableBody = document.getElementById("tableData");

let idCount = localStorage.product == null ? 0 : localData.length;
var productArr = localStorage.product == null ? [] : JSON.parse(localStorage.product);

function getTotal() {
    if (!(price.value <= 0)) {
        totalResult.style.backgroundColor = "green";
        var totalPrice = +price.value + +taxes.value + +ads.value + +discount.value;
        totalResult.textContent = totalPrice;
    }
    if (price.value === "") {
        totalResult.textContent = "0";
        totalResult.style.backgroundColor = "#ac235a";
    }
}
