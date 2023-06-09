document.addEventListener('DOMContentLoaded', () => {
  const toggleSwitch = document.querySelector('.toggle-switch');
  const modeText = document.querySelector('.mode-text');
  const sunIcon = document.querySelector('.sun');
  const moonIcon = document.querySelector('.moon');
  const body = document.body;

  // Function to toggle dark mode
  function toggleDarkMode() {
    body.classList.toggle('dark');
    sunIcon.classList.toggle('active');
    moonIcon.classList.toggle('active');

    if (body.classList.contains('dark')) {
      modeText.innerText = 'Light mode';
      localStorage.setItem('darkMode', 'enabled'); // Store dark mode preference
    } else {
      modeText.innerText = 'Dark mode';
      localStorage.setItem('darkMode', 'disabled'); // Store dark mode preference
    }
  }

  // Add event listener to the toggle switch
  toggleSwitch.addEventListener('click', toggleDarkMode);

  // Check for dark mode preference on page load
  const darkModePreference = localStorage.getItem('darkMode');
  if (darkModePreference === 'enabled') {
    body.classList.add('dark');
    sunIcon.classList.add('active');
    moonIcon.classList.add('active');
    modeText.innerText = 'Light mode';
  } else {
    body.classList.remove('dark');
    sunIcon.classList.remove('active');
    moonIcon.classList.remove('active');
    modeText.innerText = 'Dark mode';
  }
});

