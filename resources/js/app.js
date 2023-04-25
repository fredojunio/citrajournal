import "./bootstrap";
import "flowbite";
import "flowbite/dist/datepicker";
import "select2/dist/js/select2";
import AutoNumeric from "autonumeric/dist/autoNumeric";
import "boxicons";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
    $(".js-example-basic-single").select2();
});

const autoNumericOptionsRupiah = {
    digitGroupSeparator: ".",
    decimalCharacter: ",",
    decimalPlaces: "0",
    decimalCharacterAlternative: ".",
    currencySymbol: "Rp. ",
    currencySymbolPlacement: AutoNumeric.options.currencySymbolPlacement.prefix,
    roundingMethod: AutoNumeric.options.roundingMethod.halfUpSymmetric,
    unformatOnSubmit: true,
    emptyInputBehavior: "press",
    watchExternalChanges: true,
};

// Initialization Autonumeric
var an = new AutoNumeric.multiple(
    ".rupiahInput",
    null,
    autoNumericOptionsRupiah
);

$(".appendbtn").click(function () {
    var template = $("#appendRow").html();
    $(".append tbody").append(template);
    $(".js-example-basic-single").select2();

    an.forEach(function (a) {
        a.remove();
    });
    an = new AutoNumeric.multiple(
        ".rupiahInput",
        null,
        autoNumericOptionsRupiah
    );
});

var tbody = document.querySelector(".append tbody");

if (tbody != null) {
    tbody.addEventListener("click", function (event) {
        if (event.target.classList.contains("removebtn")) {
            var tr = event.target.closest("tr");
            tr.parentNode.removeChild(tr);

            an.forEach(function (a) {
                a.remove();
            });
            an = new AutoNumeric.multiple(
                ".rupiahInput",
                null,
                autoNumericOptionsRupiah
            );
        }
    });
}

var selectContact = document.getElementById("contact");
if (selectContact != null) {
    selectContact.addEventListener("change", function () {
        if (selectContact.value == "addcontact") {
            var addContact = document.getElementById("addContactModal");
            const modalAdd = new Modal(addContact);
            modalAdd.show();
            selectContact.value = selectContact.options[0].value;
        }
    });
}

var selectProduct = document.getElementById("product");
if (selectProduct != null) {
    selectProduct.addEventListener("change", function () {
        if (selectProduct.value == "addproduct") {
            var addProduct = document.getElementById("addProductModal");
            const modalAdd = new Modal(addProduct);
            modalAdd.show();
            selectProduct.value = selectProduct.options[0].value;
        }
    });
}
