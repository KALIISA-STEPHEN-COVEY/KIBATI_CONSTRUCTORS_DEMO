
import os
from PIL import Image

def optimize_kibati_assets():
    base_path = r"C:\Users\adimi\Desktop\KIBATI CONSTRUCTORS DEMO"
    target_files = [
        "Copilot_20260905_193358.png",
        "Copilot_20260905_193246.png",
        "Copilot_20260905_193237.png",
        "images/Asphalt.jpg",
        "images/level.jpg",
        "images/storm-drain.jpg",
        "images/culvert-installation.jpg"
    ]
    
    for relative_path in target_files:
        full_path = os.path.join(base_path, relative_path)
        if os.path.exists(full_path):
            with Image.open(full_path) as img:
                img.thumbnail((1000, 750))
                # Hardware acceleration pass saves space instantly
                img.save(full_path, optimize=True, quality=85)
            print(f"Successfully optimized file frame: {relative_path}")

if __name__ == "__main__":
    optimize_kibati_assets()
