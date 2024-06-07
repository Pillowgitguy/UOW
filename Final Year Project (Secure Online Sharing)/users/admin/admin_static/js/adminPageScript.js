$(document).ready(function() {
    $.get('/admin/users', function(users) {
        users.forEach(function(user) {
            const dateJoined = new Date(user.DateJoined).toLocaleDateString('en-GB');
            const lastLogin = user.LastLogin ? new Date(user.LastLogin).toLocaleString('en-GB') : 'Never';
            $('#usersTable tbody').append(`
                <tr>
                    <td>${user.Username}</td>
                    <td>${user.Email}</td>
                    <td>${dateJoined}</td>
                    <td>${lastLogin}</td>
                    <td>
                        <select id="roleSelect${user.UserID}">
                            <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Admin</option>
                            <option value="endUser" ${user.role === 'endUser' ? 'selected' : ''}>End User</option>
                            <option value="suspended" ${user.role === 'suspended' ? 'selected' : ''}>Suspended</option>
                        </select>
                    </td>
                    <td><button onclick="updateUserRole(${user.UserID})">Submit</button></td>
                </tr>
            `);
        });
    });
});

function updateUserRole(userID) {
    const role = $(`#roleSelect${userID}`).val();
    $.ajax({
        url: `/admin/users/${userID}/role`,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ role }),
        success: function(response) {
            alert(response.message);
            // Optionally, you can reload data here instead of the whole page
        },
        error: function(xhr, status, error) {
            alert('Error: ' + error.message);
        }
    });
}