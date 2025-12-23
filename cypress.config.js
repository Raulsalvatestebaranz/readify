/**
 * READIFY Cypress config (XAMPP / PHP)
 * Keeping it dependency-free (no require("cypress")) = fewer config errors.
 */
module.exports = {
  e2e: {
    baseUrl: "http://localhost/readify",
    specPattern: "cypress/e2e/**/*.cy.js",
    supportFile: "cypress/support/e2e.js",
    video: false
  }
};
