document.addEventListener('DOMContentLoaded', function() {
    
    const form = document.querySelector('form[data-pmp]');
    
    
    form.addEventListener('submit', function(event) {
        
        event.preventDefault();
        
        clearErrors();
       
        if (validateForm()) {
            this.submit();
        }
    });
    
    
    function validateForm() {
        let isValid = true;
        
        
        const name = document.getElementById('name');
        if (!name.value.trim()) {
            showError(name, 'Name is required');
            isValid = false;
        } else if (name.value.length < 2) {
            showError(name, 'Name must be at least 2 characters long');
            isValid = false;
        }
        
       
        const firstName = document.getElementById('first_name');
        if (!firstName.value.trim()) {
            showError(firstName, 'First name is required');
            isValid = false;
        } else if (firstName.value.length < 2) {
            showError(firstName, 'First name must be at least 2 characters long');
            isValid = false;
        }
        
        
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim()) {
            showError(email, 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }
        
        
        const street = document.getElementById('street');
        if (!street.value.trim()) {
            showError(street, 'Street is required');
            isValid = false;
        }
        
        
        const zip = document.getElementById('zip');
        const zipValue = parseInt(zip.value);
        if (!zip.value.trim()) {
            showError(zip, 'Zip code is required');
            isValid = false;
        } else if (isNaN(zipValue)/* || zipValue.toString().length < 5 || zipValue.toString().length > 6*/) {
            showError(zip, 'Please enter a valid zip code');
            isValid = false;
        }
        
        // City validation
        const city = document.getElementById('city');
        if (!city.value) {
            showError(city, 'Please select a city');
            isValid = false;
        }
        
        return isValid;
    }
    
   
    function showError(element, message) {
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        
        
        element.classList.add('is-invalid');
        
        
        element.parentNode.appendChild(errorDiv);
    }
    
    
    function clearErrors() {
        
        const errorMessages = document.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(error => error.remove());
        
        
        const invalidInputs = document.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
    }
    
    
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const errorMessage = this.parentNode.querySelector('.invalid-feedback');
                if (errorMessage) {
                    errorMessage.remove();
                }
            }
        });
    });
});