$images = @{
    "images\services\korean-hair1.jpg" = "https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800&q=80"
    "images\services\korean-hair2.jpg" = "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=800&q=80"
    "images\services\korean-makeup1.jpg" = "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=800&q=80"
    "images\services\korean-makeup2.jpg" = "https://images.unsplash.com/photo-1512496015851-a1cbf4869c94?w=800&q=80"
    "images\services\korean-nails1.jpg" = "https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80"
    "images\services\korean-nails2.jpg" = "https://images.unsplash.com/photo-1519014816548-bf5fe059e98b?w=800&q=80"
    "images\barber\mina.jpg" = "https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&fit=crop&q=80"
    "images\barber\yuna.jpg" = "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&fit=crop&q=80"
    "images\barber\sia.jpg" = "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800&fit=crop&q=80"
    "images\salon-interior.jpg" = "https://images.unsplash.com/photo-1522337660859-02fbefca4702?w=1000&q=80"
}

foreach ($imgPath in $images.Keys) {
    $url = $images[$imgPath]
    $fullPath = Join-Path -Path $PWD -ChildPath $imgPath
    $dir = Split-Path -Path $fullPath -Parent
    if (-not (Test-Path -Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
    }
    Invoke-WebRequest -Uri $url -OutFile $fullPath
    Write-Host "Downloaded $imgPath"
}
