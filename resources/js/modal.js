function updateUser() {
    const updateUserodalTriggers = document.querySelectorAll(
        '[data-modal-toggle="updateUserModal"]'
    );
    const updateUserModal = document.querySelector("#updateUserModal");
    const idInput = updateUserModal.querySelector("#id");
    const nameInput = updateUserModal.querySelector("#name");
    const emailInput = updateUserModal.querySelector("#email");

    updateUserodalTriggers.forEach((trigger) => {
        trigger.addEventListener("click", () => {
            const id = trigger.getAttribute("data-id");
            const name = trigger.getAttribute("data-name");
            const email = trigger.getAttribute("data-email");

            idInput.value = id;
            nameInput.value = name;
            emailInput.value = email;
        });
    });
}

function destroyUser() {
    const deleteUserModalTriggers = document.querySelectorAll(
        '[data-modal-toggle="deleteModal"]'
    );
    const deleteUserModal = document.querySelector("#deleteModal");
    const idInput = deleteUserModal.querySelector("#id");

    deleteUserModalTriggers.forEach((trigger) => {
        trigger.addEventListener("click", () => {
            const id = trigger.getAttribute("data-id");

            idInput.value = id;
        });
    });
}

export { updateUser, destroyUser };
