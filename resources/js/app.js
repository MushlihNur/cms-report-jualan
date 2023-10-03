require("./bootstrap");
import "flowbite";

import { updateUser, destroyUser } from "./modal";
// import { updateSale, destroySale } from "./modal-sales";

(function () {
    updateUser();
    destroyUser();

    // updateSale();
    // destroySale();
})();
