
  function showExperienceFields() {
    const qualification = document.getElementById('qualification').value;
    const fresherSection = document.getElementById('fresherSection');
    const experiencedSection = document.getElementById('experiencedSection');

    if (qualification === 'Fresher') {
      fresherSection.style.display = 'block';
      experiencedSection.style.display = 'none';
    } else if (qualification === 'Experienced') {
      fresherSection.style.display = 'none';
      experiencedSection.style.display = 'block';
    } else {
      fresherSection.style.display = 'none';
      experiencedSection.style.display = 'none';
    }
  }
