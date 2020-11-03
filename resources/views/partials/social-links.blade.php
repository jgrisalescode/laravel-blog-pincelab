<div class="buttons-social-media-share">
    <ul class="share-buttons">
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{request()->fullUrl()}}&title={{$description}}"
            title="Share on Facebook"
            target="_blank">
                <img alt="Compartir en Facebook"
                class="img-fluid rounded-circle"
                style="width: 24px"
                src="https://www.flaticon.com/svg/static/icons/svg/1384/1384053.svg">
            </a>
        </li>
        <li>
            <a href="https://twitter.com/intent/tweet?url={{request()->fullUrl()}}&text={{$description}}&via=zendero&hashtags=zendero"
            target="_blank"
            title="Tweet">
                <img alt="Tweet"
                class="img-fluid rounded-circle"
                style="width: 24px"
                src="https://www.flaticon.com/svg/static/icons/svg/733/733579.svg">
            </a>
        </li>
        <li>
            <a href="http://pinterest.com/pin/create/link/?url={{request()->fullUrl()}}"
            target="_blank"
            title="Pin it">
                <img alt="Pin it"
                class="img-fluid rounded-circle"
                style="width: 24px"
                src="https://www.flaticon.com/premium-icon/icons/svg/2504/2504932.svg">
            </a>
        </li>
    </ul>
</div>
