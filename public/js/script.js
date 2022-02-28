function confirmBootbox(id, type) {
    alert(1);
    if (type == "delete") {
        alert(1);

        bootbox.confirm("Confirm Delete Academicterm id " + id + "? \nDeleted Academicterms cannot be recovered!", function (result) {
            return result;
        });
    }
}
