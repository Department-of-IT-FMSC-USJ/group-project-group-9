<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Report Lost Item</title>
    <link rel="stylesheet" href="report.css">
    
</head>

<body>
    <header>
        <nav></nav>
    </header>

    <main>
        <section class="report-form-container">
            <h1>Report a Lost Item</h1>
            <p>Fill out the form below to report a lost item. The more details you provide, the higher the chances of getting it back.</p>

            <form id="lostItemForm" action="report.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="itemName">Item Name</label>
                    <input type="text" id="itemName" name="itemName" placeholder="e.g., Black leather wallet" required />
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Documents">Documents</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="description">Detailed Description</label>
                    <textarea id="description" name="description" rows="4"
                        placeholder="Provide as much detail as possible about the item, including any identifying marks, its condition, and the contents (if applicable)."
                        required></textarea>
                </div>

                <div class="form-group">
                    <label for="location">Last Known Location</label>
                    <input type="text" id="location" name="location" placeholder="e.g., Nugegoda, Maharagama" required />
                </div>

                <div class="form-group">
                    <label for="dateLost">Date Lost</label>
                    <input type="date" id="dateLost" name="dateLost" required />
                </div>

                <div class="form-group full-width image-upload-container">
                    <p>Images</p>
                    <div class="image-upload-area">
                        <p>Click to upload or drag and drop</p>
                        <span>SVG, PNG, JPG or GIF (MAX. 800x600px)</span>
                        <input type="file" id="imageUpload" name="imageUpload" accept=".svg,.png,.jpg,.jpeg,.gif" />
                    </div>
                </div>

                <div class="form-group full-width bounty-container">
                    <label for="bounty">Offer a Bounty (Minimum Rs.500.00)</label>
                    <p>Offering a bounty can significantly increase the chances of your item being returned.</p>
                    <input type="number" id="bounty" name="bounty" placeholder="Rs.500.00" step="0.01" min="0" />
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn submit-btn">Submit Report</button>
                    <button type="button" class="btn cancel-btn" onclick="window.location.href='../Index.html'">Cancel</button>
                </div>
            </form>
        </section>
    </main>

    
</body>

</html>
