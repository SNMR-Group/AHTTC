
document.addEventListener('DOMContentLoaded', function () {
    fetchNotices();

    document.getElementById('notice-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'add');
        fetch('manage_notices.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Notice added successfully!');
                fetchNotices();
                this.reset();
            } else {
                alert('Error adding notice: ' + (data.error || 'Unknown error.'));
            }
        })
        .catch(error => console.error('Error adding notice:', error));
    });
});

function fetchNotices() {
    fetch('manage_notices.php')
        .then(response => response.json())
        .then(data => {
            const noticeList = document.getElementById('notice-list');
            noticeList.innerHTML = ''; // Clear existing notices
            data.forEach(notice => {
                const listItem = document.createElement('li');
                listItem.textContent = `Notice: ${notice.title} `;
                const editLink = document.createElement('a');
                editLink.href = '#';
                editLink.textContent = 'Edit';
                editLink.classList.add('btn', 'btn-warning', 'btn-sm', 'ms-2');
                editLink.addEventListener('click', function() {
                    showEditForm(notice.id, notice.title, notice.link);
                });
                const deleteLink = document.createElement('a');
                deleteLink.href = '#';
                deleteLink.textContent = 'Delete';
                deleteLink.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
                deleteLink.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this notice?')) {
                        fetch('manage_notices.php?action=delete&id=' + notice.id)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Notice deleted successfully!');
                                    fetchNotices();
                                } else {
                                    alert('Error deleting notice: ' + (data.error || 'Unknown error.'));
                                }
                            })
                            .catch(error => console.error('Error deleting notice:', error));
                    }
                });
                listItem.appendChild(editLink);
                listItem.appendChild(deleteLink);
                noticeList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching notices:', error));
}

function showEditForm(id, title, link) {
    const form = document.getElementById('notice-form');
    form.innerHTML = `
        <input type="hidden" name="id" value="${id}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="${title}" required>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" class="form-control" id="link" name="link" value="${link}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Notice</button>
    `;
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'update');
        fetch('manage_notices.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Notice updated successfully!');
                fetchNotices();
                form.innerHTML = `
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="url" class="form-control" id="link" name="link" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Notice</button>
                `;
            } else {
                alert('Error updating notice: ' + (data.error || 'Unknown error.'));
            }
        })
        .catch(error => console.error('Error updating notice:', error));
    });
}

function deleteNotice(id) {
    if (confirm('Are you sure you want to delete this notice?')) {
        fetch('manage_notices.php?action=delete&id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Notice deleted successfully!');
                    fetchNotices();
                } else {
                    alert('Error deleting notice: ' + (data.error || 'Unknown error.'));
                }
            })
            .catch(error => console.error('Error deleting notice:', error));
    }
}

//script for managing the top notices
document.addEventListener('DOMContentLoaded', function () {
    fetchTopNotice();

    document.getElementById('top-notice-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'update');
        fetch('manage_top_notice.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Top notice updated successfully!');
                fetchTopNotice();
            } else {
                alert('Error updating top notice: ' + (data.error || 'Unknown error.'));
            }
        })
        .catch(error => console.error('Error updating top notice:', error));
    });
});

function fetchTopNotice() {
    fetch('manage_top_notice.php?action=fetch')
        .then(response => response.json())
        .then(data => {
            const topNoticeTextarea = document.getElementById('top-notice-message');
            topNoticeTextarea.value = data.message;
        })
        .catch(error => console.error('Error fetching top notice:', error));
}

