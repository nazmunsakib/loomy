/**
 * Frontend GSAP Animations for Loomy Hero Block
 */
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    const heroes = document.querySelectorAll('.loomy-hero');
    
    if (!heroes.length) return;

    heroes.forEach((hero) => {
        const title = hero.querySelector('.hero-title');
        const description = hero.querySelector('.hero-description');
        const buttons = hero.querySelector('.hero-buttons');
        const bgElements = hero.querySelectorAll('.bg-primary, .bg-secondary');

        // Initial state
        gsap.set([title, description, buttons], { opacity: 0, y: 50 });
        gsap.set(bgElements, { scale: 0.8, opacity: 0 });

        // Animation Timeline
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: hero,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });

        tl.to(bgElements, {
            opacity: 0.3,
            scale: 1,
            duration: 2,
            stagger: 0.5,
            ease: 'power2.out'
        })
        .to(title, {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: 'expo.out'
        }, '-=1.5')
        .to(description, {
            opacity: 0.8,
            y: 0,
            duration: 1,
            ease: 'power3.out'
        }, '-=0.8')
        .to(buttons, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'back.out(1.7)'
        }, '-=0.5');

        // Subtle parallax on mouse move
        hero.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const xPos = (clientX / window.innerWidth - 0.5) * 30;
            const yPos = (clientY / window.innerHeight - 0.5) * 30;

            gsap.to(bgElements, {
                x: xPos,
                y: yPos,
                duration: 1.5,
                ease: 'power2.out'
            });
        });
    });
});
