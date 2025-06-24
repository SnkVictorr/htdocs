"use client";
import React from "react";
import useEmblaCarousel from "embla-carousel-react";
import Image from "next/image";
import "./styles.css"; // Import the styles for the carousel

export default function BannerHome() {
  const [emblaRef] = useEmblaCarousel({
    loop: true,
  });

  const slides = [
    "https://placehold.co/1920x1080/png?text=Slide+1",
    "https://placehold.co/1920x1080/png?text=Slide+2",
    "https://placehold.co/1920x1080/png?text=Slide+3",
  ];

  return (
    <section className="">
      <div className="embla" ref={emblaRef}>
        <div className="embla__container">
          {slides.map((slide, index) => (
            <div className="embla__slide" key={index}>
              <Image
                src={slide}
                alt={`Slide ${index + 1}`}
                width={1920}
                height={1080}
              />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
