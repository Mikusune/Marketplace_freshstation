document.getElementById('profile-button').addEventListener('click', function() {
    var profileCard = document.getElementById('profile-card');
    if (profileCard.style.display === 'block') {
        profileCard.style.display = 'none';
    } else {
        profileCard.style.display = 'block';
    }
});

window.onclick = function(event) {
    if (!event.target.matches('#profile-button')) {
        var profileCard = document.getElementById('profile-card');
        if (profileCard.style.display === 'block') {
            profileCard.style.display = 'none';
        }
    }
}