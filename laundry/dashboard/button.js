function isDeleteAllowed() {
    // Get the user's role
    const role = getUserRole();
  
    // Check if the user has the "delete" role
    return role === "admin";
  }
  
  // Only show the delete button if the user is allowed to delete
  if (isDeleteAllowed()) {
    document.querySelector(".delete-button").style.display = "block";
  } else {
    document.querySelector(".delete-button").style.display = "none";
  }