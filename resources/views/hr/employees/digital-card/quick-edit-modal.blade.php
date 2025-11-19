<!-- Quick Edit Modal -->
<div id="quickEditModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title" style="font-weight: 600;">
                    <i class="fas fa-edit"></i> Quick Edit Digital Card
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form id="quickEditForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Full Name</label>
                                <input type="text" name="full_name" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Current Position</label>
                                <input type="text" name="current_position" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Company Name</label>
                                <input type="text" name="company_name" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Phone</label>
                                <input type="text" name="phone" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Location</label>
                                <input type="text" name="location" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Professional Summary</label>
                                <textarea name="summary" rows="3" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Skills (comma separated)</label>
                                <textarea name="skills" rows="2" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Hobbies (comma separated)</label>
                                <textarea name="hobbies" rows="2" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links-section" style="margin-top: 20px;">
                        <h6 style="font-weight: 600; color: #374151; margin-bottom: 15px;">
                            <i class="fas fa-share-alt"></i> Social Links
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">LinkedIn</label>
                                    <input type="url" name="linkedin" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">GitHub</label>
                                    <input type="url" name="github" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Portfolio</label>
                                    <input type="url" name="portfolio" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Twitter</label>
                                    <input type="url" name="twitter" class="form-control" style="border-radius: 8px; border: 2px solid #e5e7eb; padding: 12px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e5e7eb; padding: 20px 30px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" id="saveQuickEdit" class="btn btn-primary" style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; border-radius: 8px; padding: 10px 20px;">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.modal {
    animation: fadeIn 0.3s ease-out;
}

.modal-dialog {
    animation: slideInDown 0.4s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.social-links-section {
    background: #f8fafc;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
</style>

<script>
function openQuickEditModal(employeeId) {
    // Fetch current data and populate modal
    fetch(`/employees/${employeeId}/digital-card`)
        .then(response => response.json())
        .then(data => {
            if (data.digitalCard) {
                const form = document.getElementById('quickEditForm');
                Object.keys(data.digitalCard).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = data.digitalCard[key] || '';
                    }
                });
            }
            $('#quickEditModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching digital card data:', error);
            showNotification('Error loading data', 'error');
        });
}

document.getElementById('saveQuickEdit').addEventListener('click', function() {
    const form = document.getElementById('quickEditForm');
    const formData = new FormData(form);
    const employeeId = window.currentEmployeeId; // Set this globally
    
    // Show loading state
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    // Send multiple requests for each field
    const promises = [];
    for (let [field, value] of formData.entries()) {
        if (field !== '_token') {
            promises.push(
                fetch(`/employees/${employeeId}/digital-card/quick-edit`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ field, value })
                })
            );
        }
    }
    
    Promise.all(promises)
        .then(responses => {
            const allSuccessful = responses.every(response => response.ok);
            if (allSuccessful) {
                $('#quickEditModal').modal('hide');
                showNotification('Digital card updated successfully!', 'success');
                // Reload the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                throw new Error('Some updates failed');
            }
        })
        .catch(error => {
            console.error('Error updating digital card:', error);
            showNotification('Error updating digital card', 'error');
        })
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="fas fa-save"></i> Save Changes';
        });
});
</script>