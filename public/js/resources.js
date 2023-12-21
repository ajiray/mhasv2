var csrfToken = document.documentElement.dataset.csrf;

function filterClicked(bgColor, textColor, button, lineClass) {
    // Check if the button has the 'active' class
    var isActive = $(button).hasClass('active');

    // Toggle the 'active' class for the button
    $(button).toggleClass('active');

    // Toggle the 'active' class for the line
    $('.' + lineClass).toggleClass('active');

    // Set styles based on the 'active' state
    if (isActive) {
        // Revert to default styles for the button
        $(button).css('background-color', '').css('color', '');

        // Revert to default styles for the line
        $('.' + lineClass).css('background-color', '');
    } else {
        // Apply the specified styles for the button
        $(button).css('background-color', bgColor).css('color', textColor);

        // Apply the specified styles for the line
        $('.' + lineClass).css('background-color', bgColor);
    }

    // Fetch resources only if there are still active categories
    var activeCategories = $('.active').map(function() {
        return $(this).data('category');
    }).get();

    if (activeCategories.length > 0) {
        fetchResources(activeCategories);
    } else {
        var resourceContent = $('#resourceContent');
        resourceContent.empty();
    }
}


function fetchResources(categories) {
    $.ajax({
        url: '/getResources',
        type: 'GET',
        data: { categories: categories }, // Send categories as an array
        dataType: 'json',
        success: function (data) {
            // Handle the retrieved resources data
            displayResources(data);
            console.log(data);
        },
        error: function (error) {
            console.error('Error fetching resources:', error);
        }
    });
}




function displayResources(resources) {
    // Assuming you have a container div with the id 'resourceContent'
    var resourceContent = $('#resourceContent');

    // Clear the existing content
    resourceContent.empty();

     // Sort resources based on category order
     resources.sort(function(a, b) {
        var categoryOrder = { 'pdf': 1, 'video': 2, 'infographic': 3, 'ebook': 4 };
        return categoryOrder[a.category] - categoryOrder[b.category];
    });
    
    // Container for resources using Flexbox
    var resourcesContainer = $('<div class="flex flex-wrap flex-col md:flex-row mt-8 justify-center items-center md:justify-start w-full h-full"></div>');
    // Iterate through the resources and append them to the container
    resources.forEach(function (resource) {
        var coverPhotoPath = "/storage/covers/" + resource.file_cover;
        var resourcePath = "/storage/resources/" + resource.file_content;
    
        // Individual resource item with fixed dimensions and flex layout
        var resourceItem = $('<div class="border border-solid border-gray-300 m-4 p-6 rounded-lg shadow-md text-center w-64 h-96 flex flex-col sm:mb-5 md:mb-0"></div>');
        resourceItem.append('<label class="text-gray-600 text-sm mb-2">Title</label>');
        resourceItem.append('<h3 class="text-lg mb-4 font-bold">' + resource.title + '</h3>');
        resourceItem.append('<label class="text-gray-600 text-sm mb-2">Description</label>');
        resourceItem.append('<p class="text-gray-600 mb-4 h-32 overflow-hidden">' + resource.description + '</p>');
    
        // Display cover photo if available and not in the Video category
        if ((coverPhotoPath && (resource.category === 'pdf' || resource.category === 'ebook'))) {
            // Set a specific width and height for the cover photo
            var coverPhoto = $('<img class="w-64 h-32 mb-4 object-cover" src="' + coverPhotoPath + '" alt="Cover Photo">');
            resourceItem.append(coverPhoto);
        }
    
        // Display link to the PDF file at the bottom
        if (resourcePath && (resource.category === 'pdf' || resource.category === 'ebook')) {
            var pdfLink = $('<a class="mt-auto block text-white bg-green-500 py-2 px-4 rounded-md font-bold" href="' + resourcePath + '" target="_blank">Download PDF</a>');
            resourceItem.append(pdfLink);
        }
    
        // Display YouTube video embed for the Video category
        if (resource.category === 'video') {
            // Assuming you have a container div with the id 'videoContainer'
            var videoContainer = $('<div class="mt-auto mb-4"></div>');
        
            // Get the video file name from the resource
            var videoFileName = resource.file_content;
        
            // Construct the URL for the video
            var videoUrl = "/storage/resources/" + videoFileName;
        
            // Create the video element
            var videoElement = $('<video width="100%" height="auto" controls></video>');
        
            // Create the source element for the video
            var sourceElement = $('<source src="' + videoUrl + '" type="video/mp4">');
        
            // Append the source element to the video element
            videoElement.append(sourceElement);
        
            // Append the video element to the video container
            videoContainer.append(videoElement);
        
            // Append the video container to the resource item
            resourceItem.append(videoContainer);
        }
        
    
        // Display image for the Infographic category
        if (resource.category === 'infographic' && resourcePath) {
            var infographicImage = $('<img class="w-64 h-32 mb-4 object-cover" src="' + resourcePath + '" alt="Infographic">');
            resourceItem.append(infographicImage);
    
            // Download button for Infographic
            var infographicDownloadButton = $('<a class="mt-auto block text-white bg-blue-500 py-2 px-4 rounded-md font-bold" href="' + resourcePath + '" download>Download</a>');
            resourceItem.append(infographicDownloadButton);
        }
    
        // Add margin to create a gap between resource items
        resourceItem.css('margin', '0px 10px');
    
        // Append the individual resource to the container
        resourcesContainer.append(resourceItem);
    });
    
    // Append the container to the main content
    $('#resourceContent').append(resourcesContainer);
    
    
}


function toggleInputs() {
    var category = document.getElementById('category').value;
    var title = document.getElementById('title-label');
    var description = document.getElementById('description-label');
    var pdf = document.getElementById('pdf-label');
    var coverPhoto = document.getElementById('cover-photo-label');
    var youtubeLink = document.getElementById('youtube-link-label');
    var infographic = document.getElementById('infographic-label');
    var ebook = document.getElementById('ebook-label');
    var titleInput = document.getElementById('title');
    var descriptionInput = document.getElementById('description');
    var pdfInput = document.getElementById('file_content'); // Updated ID for PDF file input
    var coverPhotoInput = document.getElementById('file_cover'); // Updated ID for cover photo input
    var youtubeLinkInput = document.getElementById('video');
    var infographicInput = document.getElementById('infographic');
    var ebookInput = document.getElementById('ebook');
    var submitRes = document.getElementById('submitRes');

    if (category === 'pdf') {
        submitRes.style.display = 'block';
        title.style.display = 'block';
        description.style.display = 'block';
        pdf.style.display = 'block';
        titleInput.style.display = 'block';
        descriptionInput.style.display = 'block';
        pdfInput.style.display = 'block';
        coverPhoto.style.display = 'block';
        coverPhotoInput.style.display = 'block';
        youtubeLink.style.display = 'none';
        youtubeLinkInput.style.display = 'none';
        infographic.style.display = 'none';
        infographicInput.style.display = 'none';
        ebook.style.display = 'none';
        ebookInput.style.display = 'none';
    } else if (category === 'video') {
        submitRes.style.display = 'block';
        title.style.display = 'block';
        description.style.display = 'block';
        pdf.style.display = 'none';
        titleInput.style.display = 'block';
        descriptionInput.style.display = 'block';
        pdfInput.style.display = 'none';
        coverPhoto.style.display = 'none';
        coverPhotoInput.style.display = 'none';
        youtubeLink.style.display = 'block';
        youtubeLinkInput.style.display = 'block';
        infographic.style.display = 'none';
        infographicInput.style.display = 'none';
        ebook.style.display = 'none';
        ebookInput.style.display = 'none';
    } else if (category === 'infographic') {
        submitRes.style.display = 'block';
        title.style.display = 'block';
        description.style.display = 'block';
        pdf.style.display = 'none';
        titleInput.style.display = 'block';
        descriptionInput.style.display = 'block';
        pdfInput.style.display = 'none';
        coverPhoto.style.display = 'none';
        coverPhotoInput.style.display = 'none';
        youtubeLink.style.display = 'none';
        youtubeLinkInput.style.display = 'none';
        infographic.style.display = 'block';
        infographicInput.style.display = 'block';
        ebook.style.display = 'none';
        ebookInput.style.display = 'none';
    } else if (category === 'ebook') {
        submitRes.style.display = 'block';
        title.style.display = 'block';
        description.style.display = 'block';
        pdf.style.display = 'none';
        titleInput.style.display = 'block';
        descriptionInput.style.display = 'block';
        pdfInput.style.display = 'none';
        coverPhoto.style.display = 'block';
        coverPhotoInput.style.display = 'block';
        youtubeLink.style.display = 'none';
        youtubeLinkInput.style.display = 'none';
        infographic.style.display = 'none';
        infographicInput.style.display = 'none';
        ebook.style.display = 'block';
        ebookInput.style.display = 'block';
    } else {
        submitRes.style.display = 'none';
        title.style.display = 'none';
        description.style.display = 'none';
        pdf.style.display = 'none';
        titleInput.style.display = 'none';
        descriptionInput.style.display = 'none';
        pdfInput.style.display = 'none';
        coverPhoto.style.display = 'none';
        coverPhotoInput.style.display = 'none';
        youtubeLink.style.display = 'none';
        youtubeLinkInput.style.display = 'none';
        infographic.style.display = 'none';
        infographicInput.style.display = 'none';
        ebook.style.display = 'none';
        ebookInput.style.display = 'none';
    }
}




